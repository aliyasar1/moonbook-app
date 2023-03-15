<?php

namespace App\Helpers;

use App\Models\Cart;
use Iyzipay\Model\Currency;
use Iyzipay\Model\Locale;
use Iyzipay\Model\PaymentChannel;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Request\CreatePaymentRequest;

class IyzicoRequestHelper
{
    /**
     * @param Cart $sepet
     * @param float $finalPrice
     * @return CreatePaymentRequest
     */
    public static function createRequest(Cart $sepet, float $finalPrice): CreatePaymentRequest
    {
        $request = new CreatePaymentRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId($sepet->kod);
        $request->setPrice($finalPrice);
        $request->setPaidPrice($finalPrice);
        $request->setCurrency(Currency::TL);
        $request->setInstallment(1);
        $request->setBasketId($sepet->kod);
        $request->setPaymentChannel(PaymentChannel::WEB);
        $request->setPaymentGroup(PaymentGroup::PRODUCT);
        $request->setCallbackUrl(null);


        return $request;
    }
}