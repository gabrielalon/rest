<?php

namespace ISklep\API\Services;

use ISklep\API\Curl\Request;
use ISklep\API\Services\Traits\ServiceClientTrait;

class Producer implements
    ServiceObjectInterface
{
    use ServiceClientTrait;

    /**
     * @return array
     */
    public function getAll()
    {
        return $this
            ->getClient()
            ->process(
                'producers',
                Request::METHOD_GET
            );
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function createOne($data)
    {
        return $this
            ->getClient()
            ->process(
                'producers',
                Request::METHOD_POST,
                $data
            );
    }
}