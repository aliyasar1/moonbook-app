<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\KrediKarti
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCart query()
 * @mixin \Eloquent
 */
class CreditCart extends Model
{
    use HasFactory;

    protected $fillable = [
        "adi_soyadi",
        "kart_no",
        "sk_ay",
        "sk_yil",
        "cvc",
    ];

    public function getAdiSoyadi()
    {
        return $this->adi_soyadi;
    }

    public function setAdiSoyadi($adi_soyadi): void
    {
        $this->name = $adi_soyadi;
    }

    public function getKartNo()
    {
        return $this->kart_no;
    }

    public function setKartNo($kart_no): void
    {
        $this->kart_no = $kart_no;
    }

    public function getSKay()
    {
        return $this->sk_ay;
    }

    public function setSKay($sk_ay): void
    {
        $this->sk_ay = $sk_ay;
    }

    public function getSKyil()
    {
        return $this->sk_yil;
    }

    public function setSKyil($sk_yil): void
    {
        $this->sk_yil = $sk_yil;
    }

    public function getCvc()
    {
        return $this->cvc;
    }

    public function setCvc($cvc): void
    {
        $this->cvc = $cvc;
    }

}
