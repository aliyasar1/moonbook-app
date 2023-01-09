<?php

namespace Database\Seeders;

use App\Models\YayinEvleri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YayinEvleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $yayin_evleri = [
            '3D Yayınları',
            'Marka Yayınları',
            'Fragman Yayınları',
            'Pelikan Yayınları',
            'Hayy Kitap',
            'Üç Dört Beş Yayınları',
            'Antreman Yayınları',
            'Tonguç Akademi',
            'Karekök Yayınları',
            'Yapı Kredi Yayınları',
            'İş Bankası Kültür Yayınları',
            'Can Yayınları',
            'Kırmızı Kedi Yayınları',
            'Okyanus Yayınları',
            'Limit Yayınları',
            'Pegem Yayınları',
            'Diğer...'
        ];

        foreach ($yayin_evleri as $yayinevi)
        {
            YayinEvleri::query()->create([
                'adi' => $yayinevi,
            ]);
        }
    }
}
