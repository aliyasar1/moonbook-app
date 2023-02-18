<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Favoriler;
use App\Models\Kategori;
use App\Models\Kitaplar;
use App\Models\User;
use App\Models\YayinEvleri;
use App\Models\Yazarlar;
use App\Models\Yorumlar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    public function getBooks(){
        $kitaplar = Kitaplar::query()
            ->with(['favoriler'])
            ->get();

        $kategoriler = Kategori::all();

        $favoriKitaplar = Favoriler::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('kullanicilar.kitaplar', compact('kitaplar', 'kategoriler', 'favoriKitaplar'));
    }

    public function getBooksByCategory(Kategori $kategori)
    {
        $kitaplar = Kitaplar::query()
            ->where('kategori_id', $kategori->id)
            ->get();

        $kategoriler = Kategori::all();

        $favoriKitaplar = Favoriler::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('kullanicilar.kitaplar', compact('kitaplar', 'kategoriler', 'favoriKitaplar'));
    }

    public function getBookDetails(Kitaplar $kitap)
    {
        $kitapadeti = $kitap->stok->stok_adeti;

        $yorumlar = Yorumlar::query()
            ->where('kitap_id', $kitap->id)
            ->orderByDesc('yorum')
            ->limit(3)
            ->get();

        $puanOrt = Yorumlar::query()
            ->where('kitap_id', $kitap->id)
            ->avg('puan');

        $favoriKitaplar = Favoriler::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('kullanicilar.kitap_incele', compact('kitap', 'kitapadeti', 'yorumlar', 'puanOrt', 'favoriKitaplar'));
    }

    public function postBookComment(Kitaplar $kitap)
    {
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

        return redirect()->route('kitaplar.kitap_detayi', $kitap->id);
    }

    public function getWriters()
    {
        $yazarlar = Yazarlar::all();

        return view('kullanicilar.yazarlar', compact('yazarlar'));
    }

    public function getPublishingHouses()
    {
        $yayinevleri = YayinEvleri::all();

        return view('kullanicilar.yayin_evleri', compact('yayinevleri'));
    }

    public function getSeller(User $satici)
    {
        $kitaplar = Kitaplar::query()
            ->where('satici_id', $satici->id)
            ->get();

        $favoriKitaplar = Favoriler::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('kullanicilar.saticilar', compact('satici', 'kitaplar', 'favoriKitaplar'));
    }

    public function getWriterBooks(Yazarlar $yazar)
    {
        $kitaplar = Kitaplar::query()
            ->where('yazar_id', $yazar->id)
            ->get();

        $favoriKitaplar = Favoriler::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('kullanicilar.yazar_kitaplari', compact('yazar', 'kitaplar', 'favoriKitaplar'));
    }

    public function getPublishingHouseBooks(YayinEvleri $yayinevi)
    {
        $kitaplar = Kitaplar::query()
            ->where('yayin_evi_id', $yayinevi->id)
            ->get();

        $favoriKitaplar = Favoriler::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('kullanicilar.yayin_evleri_kitaplari', compact('yayinevi', 'kitaplar', 'favoriKitaplar'));
    }

    public function getFavorites()
    {
        $favoriKitaplar = Favoriler::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('kullanicilar.favoriler', compact('favoriKitaplar'));
    }

    public function postAddFavorite(Kitaplar $kitap)
    {

        $veriler['kullanici_id'] = Auth::user()->id;
        $veriler['kitap_id'] = $kitap->id;

        Favoriler::query()->create($veriler);

        return response()->json([
            'status' => true,
            'message' => 'Favorilere Eklendi'
        ]);
    }

    public function deleteFavorite(Kitaplar $kitap)
    {

        Favoriler::query()
            ->where('kitap_id', $kitap->id)
            ->where('kullanici_id', Auth::user()->id)
            ->delete();

        return response()->json([
            'status' => true,
            'message' => 'Favorilerden Silindi'
        ]);
    }
}
