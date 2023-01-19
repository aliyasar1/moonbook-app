<?php

namespace App\Http\Controllers\Kullanicilar;

use App\Http\Controllers\Controller;
use App\Models\Favoriler;
use App\Models\Ilceler;
use App\Models\Iller;
use App\Models\Kategori;
use App\Models\Kitaplar;
use App\Models\Stok;
use App\Models\User;
use App\Models\YayinEvleri;
use App\Models\Yazarlar;
use App\Models\Yorumlar;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class KullaniciController extends Controller
{
    public function Kayit_Ol(User $user)
    {
        $iller = Iller::query()->with(['ilceler'])->get();
        $ilceler = $iller->where('il', $user->il_id)->first();
        return view('kayit_ol', compact('user', 'iller', 'ilceler'));
    }

    public function postHesap_Olustur (Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [   'fotograf' => 'sometimes',
                'adi_soyadi' => 'required',
                'kullanici_adi' => 'required|min:8',
                'email' => 'required|email',
                'tel_no' => 'min:11|max:11',
                'sifre' => 'required|min:6',
                'sifre_tekrar' => 'required_with:sifre|same:sifre',
                'il_id' => 'required',
                'ilce_id' => 'required',
                'adres' => 'required'
            ],

            [
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
            $file->storeAs('public/musteriler', $fileName);

            $inputs['fotograf'] = $fileName;
        }
        $inputs['sifre'] = base64_encode($request->sifre);
        $inputs['sifre_tekrar'] = base64_encode($request->sifre_tekrar);
        User::query()->create($inputs);

        return redirect()->route('giris_yap');
    }

    public function postIlceByIl(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'il_id' => 'required'
            ],
            [
                'il_id.required' => 'İl ID Gereklidir'
            ]
        );

        $inputs = $validator->validate();

        $ilceler = Ilceler::query()->where('il_id', $inputs['il_id'])->get();

        return response()->json($ilceler);
    }

    public function getAnasayfa () {
        $kitapRoman = Kitaplar::query()->where('kategori_id', 3)->limit(4)->get();
        $kitapKG = Kitaplar::query()->where('kategori_id', 4)->limit(4)->get();
        $kitapCR = Kitaplar::query()->where('kategori_id', 9)->limit(4)->get();
        $kitapAT = Kitaplar::query()->where('kategori_id', 6)->limit(4)->get();
        $anasayfaYorumlar = Yorumlar::query()->limit(3)->get();
        $favorikitapsayisi = count(Favoriler::query()->where('kullanici_id', Auth::user()->id)->get());
        return view('kullanicilar.anasayfa', compact('kitapRoman', 'kitapKG', 'kitapCR', 'kitapAT', 'anasayfaYorumlar', 'favorikitapsayisi'));
    }

    public function getKitaplar () {
        $kitaplar = Kitaplar::query()->with(['favoriler'])->get();
        $kategoriler = Kategori::all();
        $favoriKitaplar = Favoriler::query()->where('kullanici_id', Auth::user()->id)->get();

        $favorikitapsayisi = count(Favoriler::query()->where('kullanici_id', Auth::user()->id)->get());
        return view('kullanicilar.kitaplar', compact('kitaplar', 'kategoriler', 'favorikitapsayisi', 'favoriKitaplar'));
    }

    public function getKitaplarByKategori(Kategori $kategori)
    {
        $kitaplar = Kitaplar::query()->where('kategori_id', $kategori->id)->get();
        $kategoriler = Kategori::all();
        $favoriKitaplar = Favoriler::query()->where('kullanici_id', Auth::user()->id)->get();
        $favorikitapsayisi = count(Favoriler::query()->where('kullanici_id', Auth::user()->id)->get());
        return view('kullanicilar.kitaplar', compact('kitaplar', 'kategoriler','favorikitapsayisi', 'favoriKitaplar'));
    }

    public function getKitapIncele (Kitaplar $kitap) {
        $kitapadeti = $kitap->stok->stok_adeti;
        $yorumlar = Yorumlar::query()->where('kitap_id', $kitap->id)->orderByDesc('yorum')->limit(3)->get();
        $puanOrt = Yorumlar::query()->where('kitap_id', $kitap->id)->avg('puan');
        $favorikitapsayisi = count(Favoriler::query()->where('kullanici_id', Auth::user()->id)->get());
        return view('kullanicilar.kitap_incele', compact('kitap', 'kitapadeti','yorumlar', 'puanOrt','favorikitapsayisi'));
    }

    public function postKitapYorum(Kitaplar $kitap) {
        $validator = Validator::make(
            request()->all(),
            [
                'puan' => 'required',
                'yorum' => 'required',
            ],
            [
                'puan.required' => 'En az 1 puan vermeniz gerekiyor.',
                'yorum.required' => 'Yorum alanı boş bırakılamaz'
            ]
        );

        $veriler = $validator->validate();
        $veriler['kitap_id'] = $kitap->id;
        $veriler['kullanici_id'] = Auth::user()->id;

        Yorumlar::query()->create($veriler);

        return redirect()->route('kitap_incele', $kitap->id);
    }

    public function getYazarlar() {
        $yazarlar = Yazarlar::all();
        $favorikitapsayisi = count(Favoriler::query()->where('kullanici_id', Auth::user()->id)->get());
        return view('kullanicilar.yazarlar', compact('yazarlar','favorikitapsayisi'));
    }

    public function getYayinEvleri() {
        $yayinevleri = YayinEvleri::all();
        $favorikitapsayisi = count(Favoriler::query()->where('kullanici_id', Auth::user()->id)->get());
        return view('kullanicilar.yayin_evleri', compact('yayinevleri','favorikitapsayisi'));
    }

    public function getCikisYap() {
        Auth::logout();
        return redirect()->route('giris_yap');
    }

    public function getSaticilar (User $satici) {
        $kitaplar = Kitaplar::query()->where('satici_id', $satici->id)->get();
        $favoriKitaplar = Favoriler::query()->where('kullanici_id', Auth::user()->id)->get();
        $favorikitapsayisi = count(Favoriler::query()->where('kullanici_id', Auth::user()->id)->get());
        return view('kullanicilar.saticilar', compact('satici','kitaplar','favorikitapsayisi','favoriKitaplar'));
    }

    public function getYazarKitaplari (Yazarlar $yazar) {
        $kitaplar = Kitaplar::query()->where('yazar_id', $yazar->id)->get();
        $favoriKitaplar = Favoriler::query()->where('kullanici_id', Auth::user()->id)->get();
        $favorikitapsayisi = count(Favoriler::query()->where('kullanici_id', Auth::user()->id)->get());
        return view('kullanicilar.yazar_kitaplari', compact('yazar','kitaplar','favorikitapsayisi', 'favoriKitaplar'));
    }

    public function getYayinEviKitaplari (YayinEvleri $yayinevi) {
        $kitaplar = Kitaplar::query()->where('yayin_evi_id', $yayinevi->id)->get();
        $favoriKitaplar = Favoriler::query()->where('kullanici_id', Auth::user()->id)->get();
        $favorikitapsayisi = count(Favoriler::query()->where('kullanici_id', Auth::user()->id)->get());
        return view('kullanicilar.yayin_evleri_kitaplari', compact('yayinevi','kitaplar','favorikitapsayisi', 'favoriKitaplar'));
    }

    public function postFavoriEkle (Kitaplar $kitap) {

        $veriler['kullanici_id'] = Auth::user()->id;
        $veriler['kitap_id'] = $kitap->id;

        Favoriler::query()->create($veriler);

        return response()->json([
            'status' => true,
            'message' => 'Favorilere Eklendi'
        ]);
    }

    public function deleteFavoriSil (Kitaplar $kitap) {

        Favoriler::query()->where('kitap_id', $kitap->id)->where('kullanici_id', Auth::user()->id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Favorilerden Silindi'
        ]);
    }
}
