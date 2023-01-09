<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoriler = [
            'Edebiyat',
            'Çocuk ve Gençlik',
            'Roman',
            'Kişisel Gelişim',
            'Sınavlara Hazırlık',
            'Araştırma - Tarih',
            'Bilim',
            'Din Tasavvuf',
            'Çizgi Roman',
            'Felsefe',
        ];

        foreach ($kategoriler as $kategori)
        {
            Kategori::query()->create([
                'adi' => $kategori
            ]);
        }
    }
}
