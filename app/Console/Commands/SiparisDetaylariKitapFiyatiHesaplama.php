<?php

namespace App\Console\Commands;

use App\Models\Sepet;
use App\Models\SepetDetaylari;
use App\Models\SiparisDetaylari;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class SiparisDetaylariKitapFiyatiHesaplama extends Command
{
    protected $signature = 'siparisdetayi:fiyathesapla';

    protected $description = 'Verilen siparişlerin detay tablosundaki fiyat sütununa kitap miktarı ile hesaplanan toplam ücreti';

    public function handle()
    {
        $sepet = Sepet::query()->where('kullanici_id', Auth::user()->id)->where('is_active', 0)->get();
        $toplam = 0.00;
        $sepet_detaylari = SepetDetaylari::query()->with(['kitaplar'])->where('sepet_id', $sepet->id)->get();
        foreach ($sepet_detaylari as $sepet_detayi) {
            $toplam += $sepet_detayi->kitaplar->fiyat * $sepet_detayi->miktar;
            SiparisDetaylari::query()->update([
                'fiyat' => $toplam
            ]);
        }
        return Command::SUCCESS;
    }
}
