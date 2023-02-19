<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\SepetDetaylari
 *
 * @property int $id
 * @property int $sepet_id
 * @property int $kitap_id
 * @property int $miktar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Books $kitaplar
 * @property-read \App\Models\Cart $sepetler
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetails whereKitapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetails whereMiktar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetails whereSepetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetails whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CartDetails extends Model
{
    use HasFactory;

    protected $table = 'sepet_detaylari';

    protected $fillable = ['sepet_id', 'kitap_id', 'miktar', 'fiyat'];

    // Relations
    public function sepetler() {
        return $this->belongsTo(Cart::class,'sepet_id', 'id');
    }

    public function kitaplar () {
        return $this->belongsTo(Books::class, 'kitap_id', 'id');
    }

    // Statics
    public static function getSepettekiKitapSayisi()
    {
        $aktifSepet = collect(Auth::user()->sepetler)->where('is_active', 1)->first();

       return self::query()->where('sepet_id', $aktifSepet->id)->get()->count();
    }
}
