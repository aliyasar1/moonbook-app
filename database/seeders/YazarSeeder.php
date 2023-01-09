<?php

namespace Database\Seeders;

use App\Models\Yazarlar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YazarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $yazarlar = [
            'Mustafa Kemal Atatürk',
            'Mark Twain',
            'Victor Hugo',
            'Franz Kafka',
            'Agatha Christie',
            'Fyodor Dostoyevski',
            'Aleksandr Puşkin',
            'Alexandre Dumas',
            'Lev Tolstoy',
            'Stefan Zweig',
            'Sabahattin Ali',
            'Zülfü Livaneli',
            'Yaşar Kemal',
            'Ahmet Ümit',
            'İskender Pala',
            'George Orwell',
            'Cengiz Aymatov',
            'İlber Ortaylı',
            'Reşat Nuri Güntekin',
            'Cemal Süreyya',
            'Orhan Pamuk',
            'Peyami Safa',
            'William Shakespeare',
            'Tomris Uyar',
            'Yılmaz Özdil',
            'Necip Fazıl Kısakürek',
            'Sait Faik Abasıyanık',
            'Jack London',
            'Anton Çehov',
            'Ahmet Hamdi Tanrıpınar',
            'Özdemir Asaf',
            'Turgut Uyar',
            'Jules Verne',
            'Stephen King',
            'Oğuz Atay',
            'Diğer...'
        ];

        foreach ($yazarlar as $yazar)
        {
            Yazarlar::query()->create([
               'adi_soyadi' => $yazar,
            ]);
        }
    }
}
