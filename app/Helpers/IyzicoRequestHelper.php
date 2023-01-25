<?php

namespace App\Helpers;

use App\Models\Sepet;
use Iyzipay\Model\Currency;
use Iyzipay\Model\Locale;
use Iyzipay\Model\PaymentChannel;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Request\CreatePaymentRequest;

class IyzicoRequestHelper
{
    /**
     * @param Sepet $sepet
     * @param float $finalPrice
     * @return CreatePaymentRequest
     */
    public static function createRequest(Sepet $sepet, float $finalPrice): CreatePaymentRequest
    {
//        $request = new CreatePaymentRequest();
//        $request->setLocale(Locale::TR);
//        $request->setConversationId($sepet->kod);
//        $request->setPrice($finalPrice);
//        $request->setPaidPrice($finalPrice);
//        $request->setCurrency(Currency::TL);
//        $request->setInstallment(1);
//        $request->setBasketId($sepet->kod);
//        $request->setPaymentChannel(PaymentChannel::WEB);
//        $request->setPaymentGroup(PaymentGroup::PRODUCT);

        $request = new CreatePaymentRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId($sepet->kod);
        $request->setPrice("1");
        $request->setPaidPrice("1.2");
        $request->setCurrency(Currency::TL);
        $request->setInstallment(1);
        $request->setBasketId($sepet->kod);
        $request->setPaymentChannel(PaymentChannel::WEB);
        $request->setPaymentGroup(PaymentGroup::PRODUCT);

        return $request;
    }
}