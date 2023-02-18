<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Favoriler;
use App\Models\Ilceler;
use App\Models\Iller;
use App\Models\Kitaplar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Constraint\Count;

class AdminController extends Controller
{
    public function getAnasayfa()
    {
        $kitapsayisi = Kitaplar::query()
            ->where('satici_id', Auth::user()->id)
            ->count();

        $favoriKitapSayisi = Favoriler::query()
            ->with(['kitaplar'])
            ->whereHas('kitaplar', function ($q) {
                $q->where('satici_id', Auth::user()->id);
            })
            ->count();

        return view('admin.anasayfa', compact('kitapsayisi','favoriKitapSayisi'));
    }

    public function getSaticiOl(User $user)
    {
        $iller = Iller::query()
            ->with(['ilceler'])
            ->get();

        $ilceler = $iller->where('il', $user->il_id)->first();

        return view('admin.satici_ol', compact('user', 'iller', 'ilceler'));
    }

    public function postSaticiOl(Request $request)
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
                'email.required' => 'Email alanı boş geçilemez',
                'tel_no.min' => 'Telefon Numarası 11 haneli olmalıdır.',
                'tel_no.required' => 'Telefon Numarası alanı boş geçilemez.',
                'sifre_tekrar.same' => 'Girilen şifreler aynı değildir.',
                'adi_soyadi.required' => 'Ad Soyad alanı boş geçilemez.',
                'il_id' => 'İl alanı boş geçilemez.',
                'ilce_id' => 'İlçe alanı boş geçilemez.',
                'adres' => 'Adres alanı boş geçilemez.',
            ]
        );

        $inputs = $validator->validate();
        $inputs['type'] = User::USER_TYPE['ADMIN'];

        $file = $request->file('fotograf');

        if (is_null($file)) {
            $fileName = 'magaza.png';
            $inputs['fotograf'] = $fileName;
        } else {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/saticilar', $fileName);

            $inputs['fotograf'] = $fileName;
        }
        $inputs['sifre'] = base64_encode($request->sifre);
        $inputs['sifre_tekrar'] = base64_encode($request->sifre_tekrar);

        User::query()->create($inputs);

        return redirect()->route('satici_girisi_yap');
    }

    public function getProfilDuzenle()
    {
        $user = Auth::user();
        $iller = Iller::query()
            ->with(['ilceler'])
            ->get();

        $ilceler = $iller->where('il', $user->il_id)->first();
        return view('admin.satici.profil_duzenle', compact('user', 'iller', 'ilceler'));
    }

    public function putProfilDuzenle(Request $request, User $user)
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

        if (is_null($file)) {
            $fileName = 'default.png';
            $inputs['fotograf'] = $fileName;
        } else {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/saticilar', $fileName);

            $inputs['fotograf'] = $fileName;
        }

        $inputs['sifre'] = base64_encode($request->sifre);
        $inputs['sifre_tekrar'] = base64_encode($request->sifre_tekrar);

        $user->update($inputs);

        return redirect()->route('satici.anasayfa');
    }

    public function getCikis_yap(){
        Auth::logout();
        return redirect()->route('giris_yap');
    }
}
