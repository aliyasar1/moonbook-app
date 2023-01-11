<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
