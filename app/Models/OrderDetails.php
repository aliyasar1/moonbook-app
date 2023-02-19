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
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails whereKitapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails whereMiktar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails whereSiparisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderDetails extends Model
{
    use HasFactory;

    protected $table = 'siparis_detaylari';

    protected $fillable = ['id', 'siparis_id', 'kitap_id', 'miktar', 'fiyat'];

    public function siparisler() {
        return $this->hasMany(Orders::class, 'id', 'siparis_id');
    }

    public function kitap()
    {
        return $this->hasOne(Books::class, "id", "kitap_id");
    }

}
