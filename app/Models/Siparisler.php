<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siparisler extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'siparisler';

    protected $fillable = ['id', 'sepet_id', 'kod'];
}
