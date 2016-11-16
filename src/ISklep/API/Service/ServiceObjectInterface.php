<?php

namespace ISklep\API\Service;

use ISklep\API\Client;
use ISklep\API\Mapper\MapperObjectInterface;

interface ServiceObjectInterface
{
    /**
     * @param Client $client
     *
     * @return $this
     */
    public function setClient(Client $client);

    /**
     * @return Client
     */
    public function getClient();

    /**
     * @param MapperObjectInterface $mapper
     *
     * @return $this
     */
    public function setMapper(MapperObjectInterface $mapper = null);

    /**
     * @return MapperObjectInterface
     */
    public function getMapper();
}