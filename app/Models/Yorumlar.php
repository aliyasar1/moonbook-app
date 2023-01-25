<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Yorumlar
 *
 * @property int $id
 * @property int $kitap_id
 * @property int $kullanici_id
 * @property float $puan
 * @property string $yorum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kitaplar $kitaplar
 * @property-read \App\Models\User $kullanicilar
 * @method static \Illuminate\Database\Eloquent\Builder|Yorumlar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Yorumlar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Yorumlar query()
 * @method static \Illuminate\Database\Eloquent\Builder|Yorumlar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yorumlar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yorumlar whereKitapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yorumlar whereKullaniciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yorumlar wherePuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yorumlar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yorumlar whereYorum($value)
 * @mixin \Eloquent
 */
class Yorumlar extends Model
{
    use HasFactory;

    protected $table = 'yorumlar';

    protected $fillable = ['kitap_id', 'kullanici_id', 'puan', 'yorum'];

    public function kitaplar() {

        return $this->belongsTo(Kitaplar::class, 'kitap_id', 'id');

    }

    public function kullanicilar() {

        return $this->belongsTo(User::class,'kullanici_id', 'id');
    }
}
