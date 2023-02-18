<?php

namespace App\Http\Controllers\Customers;

use App\Helpers\IyzicoAdresHelper;
use App\Helpers\IyzicoBuyerHelper;
use App\Helpers\IyzicoOptionsHelper;
use App\Helpers\IyzicoPaymentCardHelper;
use App\Helpers\IyzicoRequestHelper;
use App\Http\Controllers\Controller;
use App\Models\Favoriler;
use App\Models\Kitaplar;
use App\Models\KrediKarti;
use App\Models\Sepet;
use App\Models\SepetDetaylari;
use App\Models\Siparisler;
use App\Models\Stok;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\BasketItemType;
use Iyzipay\Model\Payment;
use Iyzipay\Model\PayWithIyzicoInitialize;

class CartController extends Controller
{
    public function getCart()
    {
        $sepet = Sepet::query()
            ->where('kullanici_id', Auth::user()->id)
            ->where('is_active', 1)
            ->first();

        $sepet_detaylari = SepetDetaylari::query()
            ->where('sepet_id', $sepet->id)
            ->get();

        $sepetTutari = $this->calculateCartTotal($sepet);

        return view('kullanicilar.sepet', compact('sepet_detaylari', 'sepetTutari', 'sepet'));
    }

    public function postAddToCart(Kitaplar $kitap, Request $request)
    {
        $kullanici_sepeti = Sepet::query()
            ->where('kullanici_id', Auth::user()->id)
            ->where('is_active', 1)
            ->first();

        $miktar = $request->input('adet') ?? 1;

        $sepet_detaylari = new SepetDetaylari([
            'sepet_id' => $kullanici_sepeti->id,
            'kitap_id' => $kitap->id,
            'miktar' => $miktar
        ]);

        $sepet_detaylari->save();

        return response()->json([
            'status' => true,
            'message' => 'Sepete Eklendi'
        ]);
    }

    public function deleteFromCart(Sepet $sepet, Kitaplar $kitap)
    {
        SepetDetaylari::query()
            ->where('sepet_id', $sepet->id)
            ->where('kitap_id', $kitap->id)
            ->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sepetten Silindi',
        ]);
    }

    public function putCart(SepetDetaylari $sepetDetaylari)
    {
        $sepetDetaylari->update();

        return response()->json([
            'status' => true,
            'message' => 'Sepet Güncellendi'
        ]);
    }

    public function postConfirmCart(Request $request)
    {

        $krediKarti = new KrediKarti();

        $kart = $this->prepare($request, $krediKarti->getFillable());
        $krediKarti->fill($kart);

        $sepet = $this->getOrCreateCart();

        $sepetTutari = $this->calculateCartTotal($sepet);

        $request = IyzicoRequestHelper::createRequest($sepet, $sepetTutari);

        $paymentCard = IyzicoPaymentCardHelper::getPaymentCard($krediKarti);
        $request->setPaymentCard($paymentCard);

        $buyer = IyzicoBuyerHelper::getBuyer();
        $request->setBuyer($buyer);

        $kargoAdresi = IyzicoAdresHelper::getAdres();
        $request->setShippingAddress($kargoAdresi);

        $faturaAdresi = (new IyzicoAdresHelper)->getFaturaAdresi();
        $request->setBillingAddress($faturaAdresi);

        $sepettekiKitaplar = $this->getBasketItems($sepet);
        $request->setBasketItems($sepettekiKitaplar);

        $options = IyzicoOptionsHelper::getTestOptions();

        $payment = Payment::create($request, $options);

        if ($payment->getStatus() == "success") {

            // Sepeti sona erdir.
            $this->finalizeCart($sepet);

            // Sipariş oluştur
            $this->createOrderWithDetails($sepet);

            return view("kullanicilar.odeme_alindi", compact('sepet'));
        } else {
            $errorMessage = $payment->getErrorMessage();

            return view("kullanicilar.odeme_hatali", compact('errorMessage'));
        }
    }

    private function finalizeCart(Sepet $sepet)
    {
        Sepet::query()
            ->where('id', $sepet->id)
            ->update(['is_active' => 0]);

        Sepet::query()->firstOrCreate(
            ['kullanici_id' => Auth::user()->id, 'is_active' => true],
            ['kod' => Str::random(8)]
        );
    }

    private function calculateCartTotal(Sepet $sepet)
    {
        $toplam = 0;
        $sepet_detaylari = SepetDetaylari::query()
            ->with(['kitaplar'])->where('sepet_id', $sepet->id)
            ->get();

        foreach ($sepet_detaylari as $sepet_detayi) {
            $toplam += $sepet_detayi->kitaplar->fiyat * $sepet_detayi->miktar;
        }
        return $toplam;
    }

    private function getOrCreateCart()
    {
        $kullanici = Auth::user();
        $sepetolustur = Sepet::query()->firstOrCreate(
            ['kullanici_id' => $kullanici->id, 'is_active' => true],
            ['kod' => Str::random(8)]
        );
        return $sepetolustur;
    }

    private function getBasketItems(Sepet $sepet): array
    {
        $basketItems = [];

        $sepetDetaylari = SepetDetaylari::query()
            ->with(['kitaplar'])->where('sepet_id', $sepet->id)
            ->get();

        foreach ($sepetDetaylari as $detay) {
            $item = new BasketItem();
            $item->setId(strval($detay->kitaplar->id));
            $item->setName($detay->kitaplar->adi);
            $item->setCategory1($detay->kitaplar->kategoriler->adi);
            $item->setItemType(BasketItemType::PHYSICAL);
            $item->setPrice($detay->kitaplar->fiyat);

            for ($i = 0; $i < $detay->miktar; $i++) {
                $basketItems[] = $item;
            }
        }

        return $basketItems;
    }

    private function createOrderWithDetails(Sepet $sepet): Siparisler
    {
        $siparis = new Siparisler([
            "sepet_id" => $sepet->id,
            "kod" => $sepet->kod
        ]);

        $siparis->save();

        foreach ($sepet->sepetDetaylari as $detaylar) {
            $siparis->siparis_detaylari()->create([
                'siparis_id' => $siparis->id,
                'kitap_id' => $detaylar->kitap_id,
                'miktar' => $detaylar->miktar,
                'fiyat' => $detaylar->kitaplar->fiyat * $detaylar->miktar
            ]);
            Stok::query()->where('kitap_id', $detaylar->kitap_id)->update([
                'stok_adeti' => $detaylar->kitaplar->stok->stok_adeti - $detaylar->miktar,
            ]);
        }
        return $siparis;
    }
}
