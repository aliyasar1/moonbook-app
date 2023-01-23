<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SepetDetaylari extends Model
{
    use HasFactory;

    protected $table = 'sepet_detaylari';

    protected $fillable = ['sepet_id', 'kitap_id', 'miktar'];

    public function sepetler() {
        return $this->belongsTo(Sepet::class,'sepet_id', 'id');
    }

    public function kitaplar () {
        return $this->belongsTo(Kitaplar::class, 'kitap_id', 'id');
    }
}
