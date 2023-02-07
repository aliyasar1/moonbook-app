<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Kitaplar;
use App\Models\Sepet;
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
        $user = User::query()->where('email', $inputs['email'])->where('sifre', base64_encode($inputs['sifre']))->first();

        if (! is_null($user) && $user->type === User::USER_TYPE['ADMIN']) {
            return redirect()->route('giris_yap')->with('danger', 'E-Mail veya Şifre Hatalı. Tekrar Deneyiniz!');
        } elseif (! is_null($user) && $user->type === User::USER_TYPE['USER']) {
            Auth::login($user);

            Sepet::query()->firstOrCreate(
                ['kullanici_id' => Auth::user()->id, 'is_active' => 1],
                ['kod' => Str::random(8)]
            );
            $kitapRoman = Kitaplar::query()->where('kategori_id', 3)->limit(4)->get();
            $kitapKG = Kitaplar::query()->where('kategori_id', 4)->limit(4)->get();
            $kitapCR = Kitaplar::query()->where('kategori_id', 9)->limit(4)->get();
            $kitapAT = Kitaplar::query()->where('kategori_id', 6)->limit(4)->get();
            $anasayfaYorumlar = Yorumlar::query()->orderByDesc('id')->limit(3)->get();
            return view('kullanicilar.anasayfa', compact('kitapRoman', 'kitapKG', 'kitapCR', 'kitapAT', 'anasayfaYorumlar'));
        }
        return redirect()->route('giris_yap')->with('danger', 'E-Mail veya Şifre Hatalı. Tekrar Deneyiniz!');
    }

    public function Satici_Girisi_Yap()
    {
        return view('admin.giris_yap');
    }

    public function postSatici_Girisi_Yap(LoginRequest $request)
    {
        $inputs = $request->all();

        $user = User::query()
            ->where('email', $inputs['email'])
            ->where('sifre', base64_encode($inputs['sifre']))
            ->first();

        if (! $user || $user->type === User::USER_TYPE['USER']) {
            return redirect()->route('satici_girisi_yap')->with('danger', 'E-Mail veya Şifre Hatalı. Tekrar Deneyiniz!');
        }

        Auth::login($user);
        return redirect()->route('satici.anasayfa');
    }
}
