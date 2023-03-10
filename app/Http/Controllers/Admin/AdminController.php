<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Favorites;
use App\Models\Districts;
use App\Models\Cities;
use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Constraint\Count;

class AdminController extends Controller
{
    public function getHome()
    {
        $bookQuantity = Books::query()
            ->where('satici_id', Auth::user()->id)
            ->count();

        $favoriteBookQuantity = Favorites::query()
            ->with(['kitaplar'])
            ->whereHas('kitaplar', function ($q) {
                $q->where('satici_id', Auth::user()->id);
            })
            ->count();

        return view('admin.home', compact('bookQuantity','favoriteBookQuantity'));
    }

    public function getEditProfile()
    {
        $user = Auth::user();

        $cities = Cities::query()
            ->with(['ilceler'])
            ->get();

        return view('admin.seller.editProfile', compact('user', 'cities'));
    }

    public function putEditProfile(Request $request, User $user)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'firma_adi' => 'required',
                'tckn' => 'required|numeric',
                'adi_soyadi' => 'required',
                'kullanici_adi' => 'required',
                'tel_no' => 'required|numeric',
                'email' => 'required|email',
                'sifre' => 'required|min:6',
                'sifre_tekrar' => 'required_with:sifre|same:sifre',
                'adres' => 'required',
                'il_id' => 'required',
                'ilce_id' => 'required',
            ],
            [
                'firma_adi.required' => 'Firma Adı alanı boş geçilemez',
                'tckn.required' => 'VKN/TCKN alanı boş geçilemez',
                'tckn.numeric' => 'VKN/TCKN alanına sadece sayı girişi yapılabilir.',
                'sifre.required' => 'Şifre alanı boş geçilemez.',
                'sifre.min' => 'Şifre En az 6 karakter olmalıdır.' ,
                'kullanici_adi.required' => 'Kullanıcı adı alanı boş geçilemez',
                'kullanici_adi.unique' => 'Kullanıcı adı alınmıştır.',
                'email.required' => 'Email alanı boş geçilemez',
                'email.unique' => 'Bu Email adresi kayıtlıdır.',
                'tel_no.min' => 'Telefon Numarası 11 haneli olmalıdır.',
                'sifre_tekrar.same' => 'Girilen şifreler aynı değildir.',
                'adi_soyadi.required' => 'Ad Soyad alanı boş geçilemez.',
                'il_id' => 'İl alanı boş geçilemez.',
                'ilce_id' => 'İlçe alanı boş geçilemez.',
                'adres' => 'Adres alanı boş geçilemez.',
            ]
        );

        $inputs = $validator->validate();

        $file = $request->file('fotograf');

        if(is_null($file)) {
            $fileName = $user->fotograf;
            $inputs['fotograf'] = $fileName;
        } else {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/saticilar', $fileName);

            $inputs['fotograf'] = $fileName;
        }

        $inputs['sifre'] = base64_encode($request->sifre);
        $inputs['sifre_tekrar'] = base64_encode($request->sifre_tekrar);

        $user->update($inputs);

        return redirect()->route('seller.home');
    }
}
