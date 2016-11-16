<?php

namespace ISklep\API\Service;

use ISklep\API\Curl\Request;

class Producer extends AbstractService
{
    /**
     * @return array
     */
    public function getAll()
    {
        return $this
            ->run(
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
            ->run(
                'producers',
                Request::METHOD_POST,
                $data
            );
    }
}