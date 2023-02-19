<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    public function getStockHome()
    {
        $stoklar = Stock::query()->with(['kitap'])
            ->whereHas('kitap', function ($q) {
                $q->where('satici_id', Auth::user()->id);
            })->get();

        return view('admin.books.stock', compact('stoklar'));
    }

    public function putStock(Stock $stok)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'stok_adeti' => 'numeric',
            ],
            [
                'stok_adeti.numeric' => 'Stok alanına sadece sayı girilebilir.',
            ]
        );

        $veriler = $validator->validate();

        $stok->update([
            'stok_adeti' => $veriler['stok_adeti']
        ]);

        return redirect()->route('seller.book.stok');
    }
}
