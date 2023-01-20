<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiparisDetaylari extends Model
{
    use HasFactory;

    protected $table = 'siparis_detaylari';

    protected $fillable = ['id', 'siparis_id', 'kitap_id', 'miktar'];
}
