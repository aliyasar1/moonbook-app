<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kitaplar;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StokController extends Controller
{
    public function getStokAnasayfa()
    {
        $stoklar = Stok::query()->with(['kitap'])
            ->whereHas('kitap', function ($q) {
                $q->where('satici_id', Auth::user()->id);
            })->get();

        return view('admin.kitaplar.stok', compact('stoklar'));
    }

    public function putStok(Stok $stok)
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

        return redirect()->route('satici.kitaplar.stok');
    }
}
