<?php

namespace App\Http\Controllers\Customers;

use App\Helpers\IyzicoAdresHelper;
use App\Helpers\IyzicoBuyerHelper;
use App\Helpers\IyzicoOptionsHelper;
use App\Helpers\IyzicoPaymentCardHelper;
use App\Helpers\IyzicoRequestHelper;
use App\Http\Controllers\Controller;
use App\Models\Favorites;
use App\Models\Books;
use App\Models\CreditCart;
use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Orders;
use App\Models\Stock;
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
        $cart = Cart::query()
            ->where('kullanici_id', Auth::user()->id)
            ->where('is_active', 1)
            ->first();

        $cartDetails = CartDetails::query()
            ->where('sepet_id', $cart->id)
            ->get();

        $cartSum = $this->calculateCartTotal($cart);
        $kdv = $cartSum * 0.18;

        return view('customers.cart', compact('cartDetails', 'cartSum', 'cart', 'kdv'));
    }

    public function postAddToCart(Books $book, Request $request)
    {
        $userCart = Cart::query()
            ->where('kullanici_id', Auth::user()->id)
            ->where('is_active', 1)
            ->first();

        $quantity = $request->input('adet') ?? 1;

        $cartDetails = new CartDetails([
            'sepet_id' => $userCart->id,
            'kitap_id' => $book->id,
            'miktar' => $quantity,
            'fiyat' => $book->fiyat * $quantity
        ]);

        $cartDetails->save();

        return response()->json([
            'status' => true,
            'message' => 'Sepete Eklendi'
        ]);
    }

    public function deleteFromCart(Cart $cart, Books $book)
    {
        CartDetails::query()
            ->where('sepet_id', $cart->id)
            ->where('kitap_id', $book->id)
            ->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sepetten Silindi',
        ]);
    }

    public function putCart(CartDetails $cartDetails)
    {
        $cartDetails->update();

        return response()->json([
            'status' => true,
            'message' => 'Sepet Güncellendi'
        ]);
    }

    public function postConfirmCart(Request $request)
    {

        $creditCart = new CreditCart();

        $card = $this->prepare($request, $creditCart->getFillable());
        $creditCart->fill($card);

        $cart = $this->getOrCreateCart();

        $cartSum = $this->calculateCartTotal($cart);

        $total = $cartSum + ($cartSum * 0.18);

        $request = IyzicoRequestHelper::createRequest($cart, $total);

        $paymentCard = IyzicoPaymentCardHelper::getPaymentCard($creditCart);
        $request->setPaymentCard($paymentCard);

        $buyer = IyzicoBuyerHelper::getBuyer();
        $request->setBuyer($buyer);

        $shippingAddress = IyzicoAdresHelper::getAdres();
        $request->setShippingAddress($shippingAddress);

        $billingAddress = (new IyzicoAdresHelper)->getFaturaAdresi();
        $request->setBillingAddress($billingAddress);

        $bookInCart = $this->getBasketItems($cart);
        $request->setBasketItems($bookInCart);

        $options = IyzicoOptionsHelper::getTestOptions();

        $payment = Payment::create($request, $options);

        if ($payment->getStatus() == "success") {

            // Sepeti sona erdir.
            $this->finalizeCart($cart);

            // Sipariş oluştur
            $this->createOrderWithDetails($cart);

            return view("customers.paymentSuccessful", compact('cart'));
        } else {
            $errorMessage = $payment->getErrorMessage();

            return view("customers.paymentUnsuccessful", compact('errorMessage'));
        }
    }

    private function finalizeCart(Cart $cart)
    {
        Cart::query()
            ->where('id', $cart->id)
            ->update(['is_active' => 0]);

        Cart::query()->firstOrCreate(
            ['kullanici_id' => Auth::user()->id, 'is_active' => true],
            ['kod' => Str::random(8)]
        );
    }

    private function calculateCartTotal(Cart $cart)
    {
        $total = 0;
        $cartDetails = CartDetails::query()
            ->with(['kitaplar'])
            ->where('sepet_id', $cart->id)
            ->get();

        foreach ($cartDetails as $detail) {
            $total += $detail->kitaplar->fiyat * $detail->miktar;
        }
        return $total;
    }

    private function getOrCreateCart()
    {
        $user = Auth::user();
        $createCart = Cart::query()->firstOrCreate(
            ['kullanici_id' => $user->id, 'is_active' => true],
            ['kod' => Str::random(8)]
        );
        return $createCart;
    }

    private function getBasketItems(Cart $cart): array
    {
        $basketItems = [];

        $cartDetails = CartDetails::query()
            ->with(['kitaplar'])
            ->where('sepet_id', $cart->id)
            ->get();

        foreach ($cartDetails as $detail) {
            $item = new BasketItem();
            $item->setId(strval($detail->kitaplar->id));
            $item->setName($detail->kitaplar->adi);
            $item->setCategory1($detail->kitaplar->kategoriler->adi);
            $item->setItemType(BasketItemType::PHYSICAL);
            $item->setPrice($detail->kitaplar->fiyat);

            for ($i = 0; $i < $detail->miktar; $i++) {
                $basketItems[] = $item;
            }
        }

        return $basketItems;
    }

    private function createOrderWithDetails(Cart $cart): Orders
    {
        $order = new Orders([
            "sepet_id" => $cart->id,
            "kod" => $cart->kod
        ]);

        $order->save();

        foreach ($cart->sepetDetaylari as $details) {
            $order->siparis_detaylari()
                ->create([
                'siparis_id' => $order->id,
                'kitap_id' => $details->kitap_id,
                'miktar' => $details->miktar,
                'fiyat' => $details->kitaplar->fiyat * $details->miktar
            ]);
            Stock::query()
                ->where('kitap_id', $details->kitap_id)
                ->update([
                'stok_adeti' => $details->kitaplar->stok->stok_adeti - $details->miktar,
            ]);
        }
        return $order;
    }
}
