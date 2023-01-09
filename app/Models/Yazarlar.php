<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yazarlar extends Model
{
    use HasFactory;

    protected $table = 'yazarlar';

    protected $fillable = ['adi_soyadi'];
}
