<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Category;
use App\Models\Books;
use App\Models\Favorites;
use App\Models\Stock;
use App\Models\User;
use App\Models\PublishingHouses;
use App\Models\Writers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    public function getHome()
    {
        $books = Books::query()
            ->where('satici_id', Auth::user()->id)
            ->get();

        return view('admin.books.home', compact('books'));
    }

    public function getAddBook()
    {
        $categories = Category::all();
        $writers = Writers::all();
        $publishingHouses = PublishingHouses::all();

        return view('admin.books.addBook', compact('categories', 'writers', 'publishingHouses'));
    }

    public function postAddBook(Request $request)
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

        $inputs = $validator->validate();

        $file = $request->file('fotograf');

        if (is_null($file)) {
            $fileName = 'book.png';
            $inputs['fotograf'] = $fileName;
        } else {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/saticilar/kitaplar', $fileName);

            $inputs['fotograf'] = $fileName;
        }

        $inputs['satici_id'] = Auth::user()->id;

        $kitap = Books::query()->create($inputs);

        Stock::query()->create([
            'kitap_id' => $kitap->id,
            'stok_adeti' => 0
        ]);

        return redirect()->route('seller.books.home');
    }

    public function getEditBook(Books $book)
    {
        $categories = Category::all();
        $writers = Writers::all();
        $publishingHouses = PublishingHouses::all();

     return view('admin.books.editBook', compact('book','categories', 'writers', 'publishingHouses'));
    }

    public function putEditBook(Request $request, Books $book)
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

        $inputs = $validator->validate();

        $file = $request->file('fotograf');

        if(is_null($file)) {
            $fileName = $book->fotograf;
            $inputs['fotograf'] = $fileName;
        } else {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/saticilar/kitaplar', $fileName);

            $inputs['fotograf'] = $fileName;
        }

        $book->update($inputs);


        return redirect()->route('seller.books.home');
    }

    public function deleteBook (Books $book)
    {
        $book->delete();
        return redirect()->route('seller.books.home');
    }

    public function getFavorites () {

        $favorites = Favorites::query()
            ->with('kitaplar')
            ->selectRaw('COUNT(kitap_id) as miktar, kitap_id')
            ->join('kitaplar', 'kitaplar.id', '=', 'favoriler.kitap_id')
            ->whereHas('kitaplar', function ($q) {
                $q->where('satici_id', Auth::user()->id);
            })
            ->groupBy(['kitap_id'])
            ->get();

        return view('admin.books.favorites', compact('favorites'));
    }
}
