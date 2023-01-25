<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Iyzipay\Model\Address;

class IyzicoAdresHelper
{
    /**
     * @return Address
     */
    public static function getAdres(): Address
    {
        $kullanici = Auth::user();

//        $address = new Address();
//        $address->setContactName($kullanici->adi_soyadi);
//        $address->setCity($kullanici->iller->il);
//        $address->setDistrict($kullanici->ilceler->ilce);
//        $address->setAddress($kullanici->adres);

        $shippingAddress = new Address();
        $shippingAddress->setContactName($kullanici->adi_soyadi);
        $shippingAddress->setDistrict($kullanici->ilceler->ilce);
        $shippingAddress->setCity($kullanici->iller->il);
        $shippingAddress->setCountry("Turkey");
        $shippingAddress->setAddress($kullanici->adres);
        $shippingAddress->setZipCode("34000");

        return $shippingAddress;
    }
}