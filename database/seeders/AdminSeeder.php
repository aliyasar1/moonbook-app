<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'type' => 'admin',
            'fotograf' => 'default.png',
            'firma_adi' => 'MoonBook',
            'tckn' => '10790557240',
            'adi_soyadi' => 'Ali Yaşar',
            'kullanici_adi' => 'moonbook',
            'tel_no' => '05522289441',
            'email' => 'aliyasar@moonbook.com',
            'sifre' => base64_encode('password'), // password
            'sifre_tekrar' => base64_encode('password'), // password
            'adres' => 'Küplüce Mah. İkbal Sk. No:4 D:4',
            'ilce_id' => '427',
            'il_id' => '34'
        ]);
    }
}
