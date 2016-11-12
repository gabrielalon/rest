<?php

namespace ISklep\API\Services;

use ISklep\API\Client;

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
}