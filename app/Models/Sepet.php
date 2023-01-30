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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SepetDetaylari[] $sepet_detaylari
 * @property-read int|null $sepet_detaylari_count
 * @method static \Illuminate\Database\Eloquent\Builder|Sepet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sepet newQuery()
 * @method static \Illuminate\Database\Query\Builder|Sepet onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Sepet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sepet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sepet whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sepet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sepet whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sepet whereKod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sepet whereKullaniciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sepet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Sepet withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Sepet withoutTrashed()
 * @mixin \Eloquent
 */
class Sepet extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sepetler';

    protected $fillable = ['id', 'kullanici_id', 'kod'];

    public function sepetDetaylari ()
    {
        return $this->hasMany(SepetDetaylari::class, "sepet_id", "id");
    }

    public function kullanicilar ()
    {
        return $this->belongsTo(User::class, 'kullanici_id');
    }
}
