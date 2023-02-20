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
        $stocks = Stock::query()->with(['kitap'])
            ->whereHas('kitap', function ($q) {
                $q->where('satici_id', Auth::user()->id);
            })->get();

        return view('admin.books.stock', compact('stocks'));
    }

    public function putStock(Stock $stock)
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

        $inputs = $validator->validate();

        $stock->update([
            'stok_adeti' => $inputs['stok_adeti']
        ]);

        return redirect()->route('seller.books.stock');
    }
}
