<?php

namespace ISklep\API;

use ISklep\API\Mappers\MapperObjectInterface;

class ClientFactory
{
    /**
     * @param string                     $host
     * @param Credentials                $credentials
     * @param MapperObjectInterface|NULL $mapper
     * @param LoggerInterface|NULL       $logger
     *
     * @return Client
     */
    public static function create(
        $host,
        Credentials $credentials,
        MapperObjectInterface $mapper = null,
        LoggerInterface $logger = null
    ) {
        return (new Client())
            ->setHost($host)
            ->setCredentials($credentials)
            ->setMapper($mapper)
            ->setLogger($logger);
    }
}