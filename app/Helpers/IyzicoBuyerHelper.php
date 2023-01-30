<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Iyzipay\Model\Buyer;
use function request;

class IyzicoBuyerHelper
{
    public static function getBuyer() : Buyer
    {
        $user = Auth::user();

//        $buyer = new Buyer();
//        $buyer->setId($user->id);
//        $buyer->setName($user->adi_soyadi);
//        $buyer->setGsmNumber($user->tel_no);
//        $buyer->setEmail($user->email);
//        $buyer->setRegistrationDate(Carbon::parse($user->created_at)->format("Y-m-d h:i:s"));
//        $buyer->setRegistrationAddress($user->adres);
//        $buyer->setIp(request()->ip());
//        $buyer->setDistrict($user->ilceler->ilce);
//        $buyer->setCity($user->iller->il);

        $buyer = new Buyer();
        $buyer->setId(strval($user->id));
        $buyer->setName($user->adi_soyadi);
        $buyer->setSurname("yok");
        $buyer->setIdentityNumber("12345678901");
        $buyer->setEmail($user->email);
        $buyer->setGsmNumber($user->tel_no);
        $buyer->setRegistrationDate(Carbon::parse($user->created_at)->format("Y-m-d h:i:s"));
        $buyer->setRegistrationAddress($user->adres);
        $buyer->setCity($user->iller->il);
        $buyer->setCountry("Türkiye");
        $buyer->setZipCode("34000");
        $buyer->setIp(request()->ip());

        return $buyer;
    }
}