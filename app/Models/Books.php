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
 * @property-read \App\Models\Favorites|null $favoriler
 * @property-read \App\Models\Category $kategoriler
 * @property-read \App\Models\User $saticilar
 * @property-read \App\Models\CartDetails|null $sepet_detaylari
 * @property-read \App\Models\Stock|null $stok
 * @property-read \App\Models\PublishingHouses $yayin_evleri
 * @property-read \App\Models\Writers $yazarlar
 * @property-read \App\Models\Comments|null $yorum
 * @method static \Illuminate\Database\Eloquent\Builder|Books newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Books newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Books query()
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereAciklama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereAdi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereFiyat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereFotograf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereSaticiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereSayfaSayisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereYayinEviId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereYayinYili($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereYazarId($value)
 * @mixin \Eloquent
 */
class Books extends Model
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
        return $this->belongsTo(Category::class, 'kategori_id', 'id');
    }

    public function yazarlar()
    {
        return $this->belongsTo(Writers::class, 'yazar_id', 'id');
    }

    public function yayin_evleri()
    {
        return $this->belongsTo(PublishingHouses::class, 'yayin_evi_id', 'id');
    }

    public function stok()
    {
        return $this->hasOne(Stock::class, 'kitap_id', 'id');
    }

    public function yorum()
    {
        return $this->hasOne(Comments::class,'kitap_id', 'id');
    }

    public function favoriler()
    {
        return $this->hasOne(Favorites::class, 'kitap_id');
    }

    public function sepet_detaylari() {
        return $this->hasOne(CartDetails::class, 'kitap_id');
    }
}
