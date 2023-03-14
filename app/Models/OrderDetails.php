<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\SiparisDetaylari
 *
 * @property int $id
 * @property int $siparis_id
 * @property int $kitap_id
 * @property int $miktar
 * @property int $fiyat
 * @property int $status_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|OrderDetails newModelQuery()
 * @method static Builder|OrderDetails newQuery()
 * @method static Builder|OrderDetails query()
 * @method static Builder|OrderDetails whereCreatedAt($value)
 * @method static Builder|OrderDetails whereId($value)
 * @method static Builder|OrderDetails whereKitapId($value)
 * @method static Builder|OrderDetails whereMiktar($value)
 * @method static Builder|OrderDetails whereSiparisId($value)
 * @method static Builder|OrderDetails whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderDetails extends Model
{
    use HasFactory;

    protected $table = 'siparis_detaylari';

    protected $fillable = ['id', 'siparis_id', 'kitap_id', 'miktar', 'fiyat', 'status_id'];

    public function siparisler() {
        return $this->hasOne(Orders::class, "id", "siparis_id");
    }

    public function kitap()
    {
        return $this->hasOne(Books::class, "id", "kitap_id");
    }

    public function order_status() {
        return $this->hasOne(OrderStatuses::class, 'id', 'status_id');
    }

}
