<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [ 'type', 'fotograf', 'firma_adi', 'tckn', 'adi_soyadi', 'kullanici_adi', 'tel_no', 'email', 'sifre', 'sifre_tekrar', 'adres', 'ilce_id', 'il_id' ];

    public function iller()
    {
        return $this->belongsTo(Iller::class, 'il_id', 'id');
    }

    public function ilceler()
    {
        return $this->belongsTo(Ilceler::class, 'ilce_id', 'id');
    }

    public const USER_TYPE = [
        'ADMIN' => 'admin',
        'USER' => 'user'
    ];

    // Relations
    public function favori_kitaplar()
    {
        return $this->hasMany(Favoriler::class, 'kullanici_id');
    }

    public function sepetler () {
        return $this->hasMany(Sepet::class, 'kullanici_id');
    }
}
