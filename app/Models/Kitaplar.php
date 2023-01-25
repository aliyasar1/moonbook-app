<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Kitaplar
 *
 * @property int $id
 * @property int $satici_id
 * @property string $fotograf
 * @property int $kategori_id
 * @property string $adi
 * @property int $yazar_id
 * @property int $yayin_evi_id
 * @property string|null $sayfa_sayisi
 * @property string|null $yayin_yili
 * @property string|null $aciklama
 * @property float $fiyat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Favoriler|null $favoriler
 * @property-read \App\Models\Kategori $kategoriler
 * @property-read \App\Models\User $saticilar
 * @property-read \App\Models\SepetDetaylari|null $sepet_detaylari
 * @property-read \App\Models\Stok|null $stok
 * @property-read \App\Models\YayinEvleri $yayin_evleri
 * @property-read \App\Models\Yazarlar $yazarlar
 * @property-read \App\Models\Yorumlar|null $yorum
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar whereAciklama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar whereAdi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar whereFiyat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar whereFotograf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar whereSaticiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar whereSayfaSayisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar whereYayinEviId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar whereYayinYili($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kitaplar whereYazarId($value)
 * @mixin \Eloquent
 */
class Kitaplar extends Model
{
    use HasFactory;

    protected $table = 'kitaplar';

    protected $fillable = ['id', 'satici_id', 'fotograf', 'kategori_id', 'adi', 'yazar_id', 'yayin_evi_id', 'sayfa_sayisi', 'yayin_yili', 'aciklama', 'fiyat'];

    // Relations
    public function saticilar()
    {
        return $this->belongsTo(User::class, 'satici_id', 'id');
    }

    public function kategoriler()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function yazarlar()
    {
        return $this->belongsTo(Yazarlar::class, 'yazar_id', 'id');
    }

    public function yayin_evleri()
    {
        return $this->belongsTo(YayinEvleri::class, 'yayin_evi_id', 'id');
    }

    public function stok()
    {
        return $this->hasOne(Stok::class, 'kitap_id', 'id');
    }

    public function yorum()
    {
        return $this->hasOne(Yorumlar::class,'kitap_id', 'id');
    }

    public function favoriler()
    {
        return $this->hasOne(Favoriler::class, 'kitap_id');
    }

    public function sepet_detaylari() {
        return $this->hasOne(SepetDetaylari::class, 'kitap_id');
    }
}
