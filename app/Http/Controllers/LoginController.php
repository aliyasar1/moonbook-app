<?php

namespace App\Http\Controllers;

use App\Models\Kitaplar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $kitapRoman = Kitaplar::query()->where('kategori_id', 3)->limit(4)->get();
            $kitapKG = Kitaplar::query()->where('kategori_id', 4)->limit(4)->get();
            $kitapCR = Kitaplar::query()->where('kategori_id', 9)->limit(4)->get();
            $kitapAT = Kitaplar::query()->where('kategori_id', 6)->limit(4)->get();
            return view('kullanicilar.anasayfa', compact('kitapRoman', 'kitapKG', 'kitapCR', 'kitapAT'));
        }
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
    }
}
