<?php

namespace App\Http\Controllers;

use App\Models\Favoriler;
use App\Models\Kitaplar;
use App\Models\Sepet;
use App\Models\SepetDetaylari;
use App\Models\User;
use App\Models\Yorumlar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function getGiris_Yap()
    {
        return view('giris_yap');
    }

    public function postGiris_Yap(Request $request)
    {
        $inputs = $request->all();
        $user = User::query()->where('email', $inputs['email'])->where('sifre', base64_encode($inputs['sifre']))->firstOrFail();
        Auth::login($user);
        if ($user->type === User::USER_TYPE['ADMIN']) {
            abort(403);
        } elseif ($user->type === User::USER_TYPE['USER']) {
            Sepet::query()->firstOrCreate(
                ['kullanici_id' => Auth::user()->id, 'is_active' => true],
                ['kod' => Str::random(8)]
            );
            $kitapRoman = Kitaplar::query()->where('kategori_id', 3)->limit(4)->get();
            $kitapKG = Kitaplar::query()->where('kategori_id', 4)->limit(4)->get();
            $kitapCR = Kitaplar::query()->where('kategori_id', 9)->limit(4)->get();
            $kitapAT = Kitaplar::query()->where('kategori_id', 6)->limit(4)->get();
            $anasayfaYorumlar = Yorumlar::query()->orderByDesc('id')->limit(3)->get();
            $favorikitapsayisi = count(Favoriler::query()->where('kullanici_id', Auth::user()->id)->get());
            $sepet = Sepet::query()->where('kullanici_id', Auth::user()->id)->first();
            $sepettekiKitapSayisi = count(SepetDetaylari::query()->where('sepet_id', $sepet->id)->get());
            return view('kullanicilar.anasayfa', compact('sepet','sepettekiKitapSayisi', 'kitapRoman', 'kitapKG', 'kitapCR', 'kitapAT', 'anasayfaYorumlar','favorikitapsayisi'));
        }
        return abort(404);
    }

    public function Satici_Girisi_Yap()
    {
        return view('admin.giris_yap');
    }

    public function postSatici_Girisi_Yap(Request $request)
    {
        $inputs = $request->all();

        $user = User::query()->where('email', $inputs['email'])->where('sifre', base64_encode($inputs['sifre']))->firstOrFail();
        Auth::login($user);
        if ($user->type === User::USER_TYPE['ADMIN']) {
            return redirect()->route('satici.anasayfa');
        } elseif ($user->type === User::USER_TYPE['USER']) {
            abort(403);
        }
        return abort(404);
    }
}
