<?php

namespace App\Console\Commands;

use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\OrderDetails;
use App\Models\Orders;
use Illuminate\Console\Command;

class SiparisDetaylariKitapFiyatiHesaplama extends Command
{
    protected $signature = 'sd:fiyat_hesapla';

    protected $description = 'Verilen siparişlerin detay tablosundaki fiyat sütununa kitap miktarı ile hesaplanan toplam ücreti';

    public function handle()
    {
        $sepetler = Cart::query()
            ->with(['sepetDetaylari', 'sepetDetaylari.kitaplar'])
            ->where('is_active', 0)
            ->get();


        foreach ($sepetler as $sepet) {
            foreach ($sepet->sepetDetaylari as $detay) {
                OrderDetails::query()
                    ->where('siparis_id', $sepet->siparis->id)
                    ->where('kitap_id', $detay->kitaplar->id)
                    ->update([
                        'fiyat' => $detay->kitaplar->fiyat * $detay->miktar
                    ]);

                CartDetails::query()
                    ->where('sepet_id', $sepet->id)
                    ->where('kitap_id', $detay->kitaplar->id)
                    ->update([
                        'fiyat' => $detay->kitaplar->fiyat * $detay->miktar
                    ]);
            }
        }
        return Command::SUCCESS;
    }
}
