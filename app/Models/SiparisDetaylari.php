<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SiparisDetaylari
 *
 * @property int $id
 * @property int $siparis_id
 * @property int $kitap_id
 * @property int $miktar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SiparisDetaylari newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SiparisDetaylari newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SiparisDetaylari query()
 * @method static \Illuminate\Database\Eloquent\Builder|SiparisDetaylari whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiparisDetaylari whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiparisDetaylari whereKitapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiparisDetaylari whereMiktar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiparisDetaylari whereSiparisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiparisDetaylari whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SiparisDetaylari extends Model
{
    use HasFactory;

    protected $table = 'siparis_detaylari';

    protected $fillable = ['id', 'siparis_id', 'kitap_id', 'miktar', 'fiyat'];

    public function kitap()
    {
        return $this->hasOne(Kitaplar::class, "kitap_id", "id");
    }

}
