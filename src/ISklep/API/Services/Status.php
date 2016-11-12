<?php

namespace ISklep\API\Services;

use ISklep\API\Curl\Request;
use ISklep\API\Services\Traits\ServiceClientTrait;

class Status implements
    ServiceObjectInterface
{
    use ServiceClientTrait;

    /**
     * @return array
     */
    public function getStatus()
    {
        return $this
            ->getClient()
            ->process(
                'status',
                Request::METHOD_GET
            );
    }
}