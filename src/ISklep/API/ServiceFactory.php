<?php

namespace ISklep\API;

use ISklep\API\Service\PaymentMethod;
use ISklep\API\Service\Producer;
use ISklep\API\Service\Status;

class ServiceFactory
{
    /**
     * @return Producer
     */
    public static function producer()
    {
        return new Producer();
    }

    /**
     * @return Status
     */
    public static function status()
    {
        return new Status();
    }

    /**
     * @return PaymentMethod
     */
    public static function paymentMethod()
    {
        return new PaymentMethod();
    }
}