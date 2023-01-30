<?php

namespace App\Helpers;

use Iyzipay\Options;

class IyzicoOptionsHelper
{
    /**
     * @return Options
     */
    public static function getTestOptions(): Options
    {
        $options = new Options();
        $options->setApiKey(env("TEST_IYZI_API_KEY"));
        $options->setSecretKey(env("TEST_IYZI_SECRET_KEY"));
//        $options->setBaseUrl(env("TEST_IYZI_BASE_URL"));
//        $options->setApiKey("sandbox-Vh11g1TjrJbuRKBrrMgfF59Xix0eHZxL");
//        $options->setSecretKey("ua2eWk2cZ7NnNmDCEFf6BSSQ2e15T14g");
        $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        return $options;
    }

    /**
     * @return Options
     */
    public static function getProdOptions(): Options
    {
        $options = new Options();
        $options->setApiKey(env("TEST_IYZI_API_KEY"));
        $options->setSecretKey(env("TEST_IYZI_SECRET_KEY"));
//        $options->setBaseUrl(env("IYZI_BASE_URL"));
//        $options->setApiKey("sandbox-Vh11g1TjrJbuRKBrrMgfF59Xix0eHZxL");
//        $options->setSecretKey("ua2eWk2cZ7NnNmDCEFf6BSSQ2e15T14g");
        $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        return $options;
    }
}