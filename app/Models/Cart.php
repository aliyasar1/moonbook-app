<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Sepet
 *
 * @property int $id
 * @property int $kullanici_id
 * @property string $kod
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $kullanicilar
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CartDetails[] $sepet_detaylari
 * @property-read int|null $sepet_detaylari_count
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newQuery()
 * @method static \Illuminate\Database\Query\Builder|Cart onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereKod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereKullaniciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Cart withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Cart withoutTrashed()
 * @mixin \Eloquent
 */
class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sepetler';

    protected $fillable = ['id', 'kullanici_id', 'kod'];

    public function sepetDetaylari ()
    {
        return $this->hasMany(CartDetails::class, "sepet_id", "id");
    }

    public function siparis()
    {
        return $this->hasOne(Orders::class, 'sepet_id', 'id');
    }

    public function kullanicilar ()
    {
        return $this->belongsTo(User::class,'kullanici_id', 'id');
    }
}
