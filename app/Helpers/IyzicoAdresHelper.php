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

        $shippingAddress = new Address();
        $shippingAddress->setContactName($kullanici->adi_soyadi);
//        $shippingAddress->setDistrict($kullanici->ilceler->ilce);
        $shippingAddress->setCity($kullanici->iller->il);
        $shippingAddress->setCountry("Turkey");
        $shippingAddress->setAddress($kullanici->adres);
        $shippingAddress->setZipCode("34000");


        return $shippingAddress;
    }

    /**
     * @return Address
     */
    public function getFaturaAdresi(): Address
    {
        $kullanici = Auth::user();

        $billingAddress = new Address();
        $billingAddress->setContactName($kullanici->adi_soyadi);
//        $billingAddress->setDistrict($kullanici->ilceler->ilce);
        $billingAddress->setCity($kullanici->iller->il);
        $billingAddress->setCountry("Turkey");
        $billingAddress->setAddress($kullanici->adres);
        $billingAddress->setZipCode("34000");

        return $billingAddress;
    }
}