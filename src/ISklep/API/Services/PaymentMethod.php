<?php

namespace ISklep\API\Services;

use ISklep\API\Curl\Request;
use ISklep\API\Services\Traits\ServiceClientTrait;

class PaymentMethod implements
    ServiceObjectInterface
{
    use ServiceClientTrait;

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
                'payment_methods',
                Request::METHOD_POST,
                $data
            );
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function updateOne($data)
    {
        return $this
            ->getClient()
            ->process(
                'payment_methods',
                Request::METHOD_PUT,
                $data
            );
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function deleteOne($id)
    {
        return $this
            ->getClient()
            ->process(
                'payment_methods/' . $id,
                Request::METHOD_DELETE
            );
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function getOne($id)
    {
        return $this
            ->getClient()
            ->process(
                'payment_methods/' . $id,
                Request::METHOD_GET
            );
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this
            ->getClient()
            ->process(
                'payment_methods',
                Request::METHOD_GET
            );
    }
}