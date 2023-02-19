<?php

namespace App\Helpers;

use App\Models\CreditCart;
use Iyzipay\Model\PaymentCard;

class IyzicoPaymentCardHelper
{
    /**
     * @param CreditCart $card
     * @return PaymentCard
     */
    public static function getPaymentCard(CreditCart $card): PaymentCard
    {
//        $paymentCard = new PaymentCard();
//        $paymentCard->setCardHolderName($card->getAdiSoyadi());
//        $paymentCard->setCardNumber($card->getKartNo());
//        $paymentCard->setExpireMonth($card->getSKay());
//        $paymentCard->setExpireYear($card->getSKyil());
//        $paymentCard->setCvc($card->getCvc());
//        $paymentCard->setRegisterCard(0);

        $paymentCard = new PaymentCard();
        $paymentCard->setCardHolderName($card->getAdiSoyadi());
        $paymentCard->setCardNumber($card->getKartNo());
        $paymentCard->setExpireMonth($card->getSKay());
        $paymentCard->setExpireYear($card->getSKyil());
        $paymentCard->setCvc($card->getCvc());
        $paymentCard->setRegisterCard(0);

        return $paymentCard;

    }
}