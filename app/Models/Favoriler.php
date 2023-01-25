<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Favoriler
 *
 * @property int $id
 * @property int $kullanici_id
 * @property int $kitap_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kitaplar $kitaplar
 * @property-read \App\Models\User $kullanicilar
 * @method static \Illuminate\Database\Eloquent\Builder|Favoriler newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favoriler newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favoriler query()
 * @method static \Illuminate\Database\Eloquent\Builder|Favoriler whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favoriler whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favoriler whereKitapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favoriler whereKullaniciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favoriler whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Favoriler extends Model
{
    use HasFactory;

    protected $table = 'favoriler';

    protected $fillable = ['kullanici_id', 'kitap_id'];

    // Relations
    public function kullanicilar() {
        return $this->belongsTo(User::class, 'kullanici_id', 'id');
    }

    public function kitaplar() {
        return $this->belongsTo(Kitaplar::class, 'kitap_id', 'id');
    }

    // Statics
    public static function getFavoriKitapSayisi()
    {
        return self::query()->where('kullanici_id', Auth::user()->id)->get()->count();
    }
}
