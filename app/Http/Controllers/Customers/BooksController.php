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
        $books = Books::query()
            ->with(['favoriler'])
            ->get();

        $categories = Category::all();

        $favoriteBooks = Favorites::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('customers.books', compact('books', 'categories', 'favoriteBooks'));
    }

    public function getBooksByCategory(Category $category)
    {
        $books = Books::query()
            ->where('kategori_id', $category->id)
            ->get();

        $categories = Category::all();

        $favoriteBooks = Favorites::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('customers.books', compact('books', 'categories', 'favoriteBooks'));
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

    public function postBookComment(Books $book)
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

        $inputs = $validator->validate();
        $inputs['kitap_id'] = $book->id;
        $inputs['kullanici_id'] = Auth::user()->id;

        Comments::query()->create($inputs);

        return redirect()->route('books.bookDetail', $book->id);
    }

    public function getWriters()
    {
        $writers = Writers::all();

        return view('customers.writers', compact('writers'));
    }

    public function getWriterBooks(Writers $writer)
    {
        $books = Books::query()
            ->where('yazar_id', $writer->id)
            ->get();

        $favoriteBooks = Favorites::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('customers.writerBooks', compact('writer', 'books', 'favoriteBooks'));
    }

    public function getPublishingHouses()
    {
        $publishingHouses = PublishingHouses::all();

        return view('customers.publishingHouses', compact('publishingHouses'));
    }

    public function getPublishingHouseBooks(PublishingHouses $publishingHouse)
    {
        $books = Books::query()
            ->where('yayin_evi_id', $publishingHouse->id)
            ->get();

        $favoriteBook = Favorites::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('customers.publishingHouseBooks', compact('publishingHouse', 'books', 'favoriteBook'));
    }

    public function getSeller(User $seller)
    {
        $books = Books::query()
            ->where('satici_id', $seller->id)
            ->get();

        $favoriteBook = Favorites::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('customers.sellers', compact('seller', 'books', 'favoriteBook'));
    }

    public function getFavorites()
    {
        $favoriteBooks = Favorites::query()
            ->where('kullanici_id', Auth::user()->id)
            ->get();

        return view('customers.favorites', compact('favoriteBooks'));
    }

    public function postAddFavorite(Books $book)
    {

        $inputs['kullanici_id'] = Auth::user()->id;
        $inputs['kitap_id'] = $book->id;

        Favorites::query()->create($inputs);

        return response()->json([
            'status' => true,
            'message' => 'Favorilere Eklendi'
        ]);
    }

    public function deleteFavorite(Books $book)
    {

        Favorites::query()
            ->where('kitap_id', $book->id)
            ->where('kullanici_id', Auth::user()->id)
            ->delete();

        return response()->json([
            'status' => true,
            'message' => 'Favorilerden Silindi'
        ]);
    }
}
