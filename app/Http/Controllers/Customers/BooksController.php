<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Favorites;
use App\Models\Category;
use App\Models\Books;
use App\Models\User;
use App\Models\PublishingHouses;
use App\Models\Writers;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    public function getBooks(){
        $kitaplar = Books::query()
            ->with(['favoriler'])
            ->get();

        $kategoriler = Category::all();

        $favoriKitaplar = Favorites::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('customers.books', compact('kitaplar', 'kategoriler', 'favoriKitaplar'));
    }

    public function getBooksByCategory(Category $kategori)
    {
        $kitaplar = Books::query()
            ->where('kategori_id', $kategori->id)
            ->get();

        $kategoriler = Category::all();

        $favoriKitaplar = Favorites::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('customers.books', compact('kitaplar', 'kategoriler', 'favoriKitaplar'));
    }

    public function getBookDetails(Books $kitap)
    {
        $kitapadeti = $kitap->stok->stok_adeti;

        $yorumlar = Comments::query()
            ->where('kitap_id', $kitap->id)
            ->orderByDesc('yorum')
            ->limit(3)
            ->get();

        $puanOrt = Comments::query()
            ->where('kitap_id', $kitap->id)
            ->avg('puan');

        $favoriKitaplar = Favorites::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('customers.bookDetails', compact('kitap', 'kitapadeti', 'yorumlar', 'puanOrt', 'favoriKitaplar'));
    }

    public function postBookComment(Books $kitap)
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

        Comments::query()->create($veriler);

        return redirect()->route('books.bookDetail', $kitap->id);
    }

    public function getWriters()
    {
        $writers = Writers::all();

        return view('customers.writers', compact('writers'));
    }

    public function getWriterBooks(Writers $yazar)
    {
        $kitaplar = Books::query()
            ->where('yazar_id', $yazar->id)
            ->get();

        $favoriKitaplar = Favorites::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('customers.writerBooks', compact('yazar', 'kitaplar', 'favoriKitaplar'));
    }

    public function getPublishingHouses()
    {
        $yayinevleri = PublishingHouses::all();

        return view('customers.publishingHouses', compact('yayinevleri'));
    }

    public function getPublishingHouseBooks(PublishingHouses $yayinevi)
    {
        $kitaplar = Books::query()
            ->where('yayin_evi_id', $yayinevi->id)
            ->get();

        $favoriKitaplar = Favorites::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('customers.publishingHouseBooks', compact('yayinevi', 'kitaplar', 'favoriKitaplar'));
    }

    public function getSeller(User $satici)
    {
        $kitaplar = Books::query()
            ->where('satici_id', $satici->id)
            ->get();

        $favoriKitaplar = Favorites::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('customers.sellers', compact('satici', 'kitaplar', 'favoriKitaplar'));
    }

    public function getFavorites()
    {
        $favoriKitaplar = Favorites::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('customers.favorites', compact('favoriKitaplar'));
    }

    public function postAddFavorite(Books $kitap)
    {

        $veriler['kullanici_id'] = Auth::user()->id;
        $veriler['kitap_id'] = $kitap->id;

        Favorites::query()->create($veriler);

        return response()->json([
            'status' => true,
            'message' => 'Favorilere Eklendi'
        ]);
    }

    public function deleteFavorite(Books $kitap)
    {

        Favorites::query()
            ->where('kitap_id', $kitap->id)
            ->where('kullanici_id', Auth::user()->id)
            ->delete();

        return response()->json([
            'status' => true,
            'message' => 'Favorilerden Silindi'
        ]);
    }
}
