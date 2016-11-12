<?php

namespace ISystems\API;

use ISystems\API\Services\PaymentMethod;
use ISystems\API\Services\Producer;
use ISystems\API\Services\Status;

class ServiceFactory
{
    /**
     * @param Client $client
     *
     * @return Producer
     */
    public static function producer(Client $client)
    {
        return (new Producer())
            ->setClient($client);
    }

    /**
     * @param Client $client
     *
     * @return Status
     */
    public static function status(Client $client)
    {
        return (new Status())
            ->setClient($client);
    }

    /**
     * @param Client $client
     *
     * @return PaymentMethod
     */
    public static function paymentMethod(Client $client)
    {
        return (new PaymentMethod())
            ->setClient($client);
    }
}