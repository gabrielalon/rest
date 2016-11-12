<?php

namespace ISystems\API\Services;

use ISystems\API\Curl\Request;
use ISystems\API\Services\Traits\ServiceClientTrait;

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