<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoriler extends Model
{
    use HasFactory;

    protected $table = 'favoriler';

    protected $fillable = ['kullanici_id', 'kitap_id'];

    public function kullanicilar() {
        return $this->belongsTo(User::class, 'kullanici_id', 'id');
    }

    public function kitaplar() {
        return $this->belongsTo(Kitaplar::class, 'kitap_id', 'id');
    }
}
