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
 * @property-read \App\Models\Kitaplar $kitaplar
 * @property-read \App\Models\Sepet $sepetler
 * @method static \Illuminate\Database\Eloquent\Builder|SepetDetaylari newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SepetDetaylari newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SepetDetaylari query()
 * @method static \Illuminate\Database\Eloquent\Builder|SepetDetaylari whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SepetDetaylari whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SepetDetaylari whereKitapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SepetDetaylari whereMiktar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SepetDetaylari whereSepetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SepetDetaylari whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SepetDetaylari extends Model
{
    use HasFactory;

    protected $table = 'sepet_detaylari';

    protected $fillable = ['sepet_id', 'kitap_id', 'miktar'];

    // Relations
    public function sepetler() {
        return $this->belongsTo(Sepet::class,'sepet_id', 'id');
    }

    public function kitaplar () {
        return $this->belongsTo(Kitaplar::class, 'kitap_id', 'id');
    }

    // Statics
    public static function getSepettekiKitapSayisi()
    {
        $aktifSepet = collect(Auth::user()->sepetler)->where('is_active', 1)->first();

       return self::query()->where('sepet_id', $aktifSepet->id)->get()->count();
    }
}
