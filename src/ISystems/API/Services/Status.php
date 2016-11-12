<?php

namespace ISystems\API\Services;

use ISystems\API\Curl\Request;
use ISystems\API\Services\Traits\ServiceClientTrait;

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