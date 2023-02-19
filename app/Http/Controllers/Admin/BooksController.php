<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Category;
use App\Models\Books;
use App\Models\Stock;
use App\Models\User;
use App\Models\PublishingHouses;
use App\Models\Writers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    public function getHome()
    {
        $kitaplar = Books::query()
            ->where('satici_id', Auth::user()->id)
            ->get();

        return view('admin.books.home', compact('kitaplar'));
    }

    public function getAddBook()
    {
        $kategoriler = Category::all();
        $yazarlar = Writers::all();
        $yayin_evleri = PublishingHouses::all();

        return view('admin.books.addBook', compact('kategoriler', 'yazarlar', 'yayin_evleri'));
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

        $kitap = Books::query()->create($veriler);

        Stock::query()->create([
            'kitap_id' => $kitap->id,
            'stok_adeti' => 0
        ]);

        return redirect()->route('seller.books.home');
    }

    public function getEditBook(Books $kitap)
    {
        $kategoriler = Category::all();
        $yazarlar = Writers::all();
        $yayin_evleri = PublishingHouses::all();
     return view('admin.books.editBook', compact('kitap','kategoriler', 'yazarlar', 'yayin_evleri'));
    }

    public function putEditBook (Request $request, Books $kitap)
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


        return redirect()->route('seller.books.home');
    }

    public function deleteBook (Books $kitap)
    {
        $kitap->delete();
        return redirect()->route('seller.books.home');
    }
}
