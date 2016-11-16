<?php

namespace ISklep\API;

class ClientFactory
{
    /**
     * @param string                     $host
     * @param Credentials                $credentials
     * @param LoggerInterface|NULL       $logger
     *
     * @return Client
     */
    public static function create(
        $host,
        Credentials $credentials,
        LoggerInterface $logger = null
    ) {
        return (new Client())
            ->setHost($host)
            ->setCredentials($credentials)
            ->setLogger($logger);
    }
}