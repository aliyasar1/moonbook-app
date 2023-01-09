<?php

namespace Database\Seeders;

use App\Models\Iller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IllerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $iller = [
            'Adana',
            'Adıyaman',
            'Afyon',
            'Ağrı',
            'Amasya',
            'Ankara',
            'Antalya',
            'Artvin',
            'Aydın',
            'Balıkesir',
            'Bilecik',
            'Bingöl',
            'Bitlis',
            'Bolu',
            'Burdur',
            'Bursa',
            'Çanakkale',
            'Çankırı',
            'Çorum',
            'Denizli',
            'Diyarbakır',
            'Edirne',
            'Elazığ',
            'Erzincan',
            'Erzurum',
            'Eskişehir',
            'Gaziantep',
            'Giresun',
            'Gümüşhane',
            'Hakkari',
            'Hatay',
            'Isparta',
            'Mersin',
            'İstanbul',
            'İzmir',
            'Kars',
            'Kastamonu',
            'Kayseri',
            'Kırklareli',
            'Kırşehir',
            'Kocaeli',
            'Konya',
            'Kütahya',
            'Malatya',
            'Manisa',
            'Kahramanmaraş',
            'Mardin',
            'Muğla',
            'Muş',
            'Nevşehir',
            'Niğde',
            'Ordu',
            'Rize',
            'Sakarya',
            'Samsun',
            'Siirt',
            'Sinop',
            'Sivas',
            'Tekirdağ',
            'Tokat',
            'Trabzon',
            'Tunceli',
            'Şanlıurfa',
            'Uşak',
            'Van',
            'Yozgat',
            'Zonguldak',
            'Aksaray',
            'Bayburt',
            'Karaman',
            'Kırıkkale',
            'Batman',
            'Şırnak',
            'Bartın',
            'Ardahan',
            'Iğdır',
            'Yalova',
            'Karabük',
            'Kilis',
            'Osmaniye',
            'Düzce'
        ];

        foreach ($iller as $value) {
            Iller::query()->create([
                'Il' => $value
            ]);
        }
    }
}
