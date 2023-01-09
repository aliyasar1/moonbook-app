<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YayinEvleri extends Model
{
    use HasFactory;

    protected $table = 'yayin_evleri';

    protected $fillable = ['adi'];
}
