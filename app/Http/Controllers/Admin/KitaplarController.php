<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iller;
use App\Models\Kategori;
use App\Models\Kitaplar;
use App\Models\Stok;
use App\Models\User;
use App\Models\YayinEvleri;
use App\Models\Yazarlar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KitaplarController extends Controller
{
    public function getAnasayfa()
    {
        $kitaplar = Kitaplar::query()->where('satici_id', Auth::user()->id)->get();
        $toplamkitap = count($kitaplar);
        $kategoriler = Kategori::all();
        $yazarlar = Yazarlar::all();
        $yayin_evleri = YayinEvleri::all();
        return view('admin.kitaplar.anasayfa', compact('kitaplar', 'kategoriler', 'yazarlar', 'yayin_evleri', 'toplamkitap'));
    }

    public function getKitap_Ekle()
    {
        $kategoriler = Kategori::all();
        $yazarlar = Yazarlar::all();
        $yayin_evleri = YayinEvleri::all();
        return view('admin.kitaplar.kitap_ekle', compact('kategoriler', 'yazarlar', 'yayin_evleri'));
    }

    public function postKitap_Ekle(Request $request)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'kategori_id' => 'required',
                'yazar_id' => 'required',
                'adi' => 'required',
                'yayin_evi_id' => 'required',
                'fiyat' => 'required|numeric',
                'sayfa_sayisi' => 'sometimes',
                'yayin_yili' => 'sometimes',
                'aciklama' => 'sometimes'
            ],
            [
                'kategori_id.required' => 'Kategori alanı boş geçilemez!',
                'yazar_id.required' => 'Yazar alanı boş geçilemez!',
                'adi.required' => 'Kitap adı alanı boş geçilemez!',
                'yayin_evi_id.required' => 'Yayın evi alanı boş geçilemez!',
                'fiyat.required' => 'Fiyat alanı boş geçilemez!',
                'fiyat.numeric' => 'Fiyat alanına sadece sayı girilebilir!',
            ]
        );

        $veriler = $validator->validate();

        $file = $request->file('fotograf');

        if (is_null($file)) {
            $fileName = 'book.png';
            $veriler['fotograf'] = $fileName;
        } else {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/saticilar/kitaplar', $fileName);

            $veriler['fotograf'] = $fileName;
        }

        $veriler['satici_id'] = Auth::user()->id;

        $kitap = Kitaplar::query()->create($veriler);

        Stok::query()->create([
            'kitap_id' => $kitap->id,
            'stok_adeti' => 0
        ]);

        return redirect()->route('satici.kitaplar.anasayfa');
    }

    public function getKitapDuzenle(Kitaplar $kitap)
    {
        $kategoriler = Kategori::all();
        $yazarlar = Yazarlar::all();
        $yayin_evleri = YayinEvleri::all();
     return view('admin.kitaplar.kitap_duzenle', compact('kitap','kategoriler', 'yazarlar', 'yayin_evleri'));
    }

    public function putKitapDuzenle (Request $request, Kitaplar $kitap)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'kategori_id' => 'required',
                'yazar_id' => 'required',
                'adi' => 'required',
                'yayin_evi_id' => 'required',
                'fiyat' => 'required|numeric',
                'sayfa_sayisi' => 'sometimes',
                'yayin_yili' => 'sometimes',
                'aciklama' => 'sometimes'
            ],
            [
                'kategori_id.required' => 'Kategori alanı boş geçilemez!',
                'yazar_id.required' => 'Yazar alanı boş geçilemez!',
                'adi.required' => 'Kitap adı alanı boş geçilemez!',
                'yayin_evi_id.required' => 'Yayın evi alanı boş geçilemez!',
                'fiyat.required' => 'Fiyat alanı boş geçilemez!',
                'fiyat.numeric' => 'Fiyat alanına sadece sayı girilebilir!',
            ]
        );

        $veriler = $validator->validate();

        $file = $request->file('fotograf');

        if (is_null($file)) {
            $fileName = $kitap->fotograf;
            $veriler['fotograf'] = $fileName;
        } else {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/saticilar/kitaplar', $fileName);

            $veriler['fotograf'] = $fileName;
        }

        $kitap->update($veriler);


        return redirect()->route('satici.kitaplar.anasayfa');
    }

    public function deleteKitap (Kitaplar $kitap)
    {
        $kitap->delete();
        return redirect()->route('satici.kitaplar.anasayfa');
    }
}
