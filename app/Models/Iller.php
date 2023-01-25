<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Iller
 *
 * @property int $id
 * @property string $il
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ilceler[] $ilceler
 * @property-read int|null $ilceler_count
 * @method static \Illuminate\Database\Eloquent\Builder|Iller newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Iller newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Iller query()
 * @method static \Illuminate\Database\Eloquent\Builder|Iller whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Iller whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Iller whereIl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Iller whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Iller extends Model
{
    use HasFactory;

    protected $table = 'iller';

    protected $fillable = ['il'];

    public const ILLER = [
        'Adana' => 'Adana',
        'Adıyaman' => 'Adıyaman',
        'Afyon' => 'Afyon',
        'Ağrı' => 'Ağrı',
        'Amasya' => 'Amasya',
        'Ankara' => 'Ankara',
        'Antalya' => 'Antalya',
        'Artvin' => 'Artvin',
        'Aydın' => 'Aydın',
        'Balıkesir' => 'Balıkesir',
        'Bilecik' => 'Bilecik',
        'Bingöl' => 'Bingöl',
        'Bitlis' => 'Bitlis',
        'Bolu' => 'Bolu',
        'Burdur' => 'Burdur',
        'Bursa' => 'Bursa',
        'Çanakkale' => 'Çanakkale',
        'Çankırı' => 'Çankırı',
        'Çorum' => 'Çorum',
        'Denizli' => 'Denizli',
        'Diyarbakır' => 'Diyarbakır',
        'Edirne' => 'Edirne',
        'Elazığ' => 'Elazığ',
        'Erzincan' => 'Erzincan',
        'Erzurum' => 'Erzurum',
        'Eskişehir' => 'Eskişehir',
        'Gaziantep' => 'Gaziantep',
        'Giresun' => 'Giresun',
        'Gümüşhane' => 'Gümüşhane',
        'Hakkari' => 'Hakkari',
        'Hatay' => 'Hatay',
        'Isparta' => 'Isparta',
        'Mersin' => 'Mersin',
        'İstanbul' => 'İstanbul',
        'İzmir' => 'İzmir',
        'Kars' => 'Kars',
        'Kastamonu' => 'Kastamonu',
        'Kayseri' => 'Kayseri',
        'Kırklareli' => 'Kırklareli',
        'Kırşehir' => 'Kırşehir',
        'Kocaeli' => 'Kocaeli',
        'Konya' => 'Konya',
        'Kütahya' => 'Kütahya',
        'Malatya' => 'Malatya',
        'Manisa' => 'Manisa',
        'Kahramanmaraş' => 'Kahramanmaraş',
        'Mardin' => 'Mardin',
        'Muğla' => 'Muğla',
        'Muş' => 'Muş',
        'Nevşehir' => 'Nevşehir',
        'Niğde' => 'Niğde',
        'Ordu' => 'Ordu',
        'Rize' => 'Rize',
        'Sakarya' => 'Sakarya',
        'Samsun' => 'Samsun',
        'Siirt' => 'Siirt',
        'Sinop' => 'Sinop',
        'Sivas' => 'Sivas',
        'Tekirdağ' => 'Tekirdağ',
        'Tokat' => 'Tokat',
        'Trabzon' => 'Trabzon',
        'Tunceli' => 'Tunceli',
        'Şanlıurfa' => 'Şanlıurfa',
        'Uşak' => 'Uşak',
        'Van' => 'Van',
        'Yozgat' => 'Yozgat',
        'Zonguldak' => 'Zonguldak',
        'Aksaray' => 'Aksaray',
        'Bayburt' => 'Bayburt',
        'Karaman' => 'Karaman',
        'Kırıkkale' => 'Kırıkkale',
        'Batman' => 'Batman',
        'Şırnak' => 'Şırnak',
        'Bartın' => 'Bartın',
        'Ardahan' => 'Ardahan',
        'Iğdır' => 'Iğdır',
        'Yalova' => 'Yalova',
        'Karabük' => 'Karabük',
        'Kilis' => 'Kilis',
        'Osmaniye' => 'Osmaniye',
        'Düzce' => 'Düzce'
    ];

    public function ilceler()
    {
        return $this->hasMany(Ilceler::class, 'il_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
    }
}
