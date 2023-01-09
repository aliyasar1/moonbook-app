<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $table = 'stok_durumu';

    protected $fillable = ['kitap_id', 'stok_adeti'];

    public function kitap()
    {
        return $this->belongsTo(Kitaplar::class, 'kitap_id', 'id');
    }
}
