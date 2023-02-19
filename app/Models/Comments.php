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
 * @property-read \App\Models\Books $kitaplar
 * @property-read \App\Models\User $kullanicilar
 * @method static \Illuminate\Database\Eloquent\Builder|Comments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comments query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereKitapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereKullaniciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments wherePuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereYorum($value)
 * @mixin \Eloquent
 */
class Comments extends Model
{
    use HasFactory;

    protected $table = 'yorumlar';

    protected $fillable = ['kitap_id', 'kullanici_id', 'puan', 'yorum'];

    public function kitaplar() {

        return $this->belongsTo(Books::class, 'kitap_id', 'id');

    }

    public function kullanicilar() {

        return $this->belongsTo(User::class,'kullanici_id', 'id');
    }
}
