<?php

namespace App\Http\Controllers\Kullanicilar;

use App\Http\Controllers\Controller;
use App\Models\Favoriler;
use App\Models\Kitaplar;
use App\Models\Sepet;
use App\Models\SepetDetaylari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SepetController extends Controller
{
    public function getSepet () {
        $favorikitapsayisi = count(Favoriler::query()->where('kullanici_id', Auth::user()->id)->get());
        $sepet = Sepet::query()->where('kullanici_id', Auth::user()->id)->first();
        $sepettekiKitapSayisi = count(SepetDetaylari::query()->where('sepet_id', $sepet->id)->get());
        $sepet_detaylari = SepetDetaylari::query()->where('sepet_id', $sepet->id)->get();
        $sepetTutari = $this->SepetiHesapla();
        return view('kullanicilar.sepet', compact('sepet_detaylari', 'sepetTutari', 'favorikitapsayisi', 'sepettekiKitapSayisi', 'sepet'));
    }

    public function postSepeteEkle(Kitaplar $kitap, Request $request) {
        $kullanici_sepeti = Sepet::query()->where('kullanici_id', Auth::user()->id)->first();
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

    public function deleteSepettenSil(Sepet $sepet, Kitaplar $kitap) {
        SepetDetaylari::query()
            ->where('sepet_id', $sepet->id)
            ->where('kitap_id', $kitap->id)
            ->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sepetten Silindi',
        ]);
    }

    private function SepetiHesapla () {
        $toplam = 0;
        $sepet = Sepet::query()->where('kullanici_id', Auth::user()->id)->first();
        $sepet_detaylari = SepetDetaylari::query()->with(['kitaplar'])->where('sepet_id', $sepet->id)->get();
        foreach ($sepet_detaylari as $sepet_detayi) {
            $toplam += $sepet_detayi->kitaplar->fiyat * $sepet_detayi->miktar;
        }
        return $toplam;
    }
}
