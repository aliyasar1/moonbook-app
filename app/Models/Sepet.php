<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use mysql_xdevapi\Table;

class Sepet extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sepetler';

    protected $fillable = ['id', 'kullanici_id', 'kod'];
}
