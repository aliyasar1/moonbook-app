<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitaplar extends Model
{
    use HasFactory;

    protected $table = 'kitaplar';

    protected $fillable = ['id', 'satici_id', 'fotograf', 'kategori_id', 'adi', 'yazar_id', 'yayin_evi_id', 'sayfa_sayisi', 'yayin_yili', 'aciklama', 'puan', 'fiyat'];

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
}
