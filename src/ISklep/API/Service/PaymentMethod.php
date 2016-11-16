<?php

namespace ISklep\API\Service;

use ISklep\API\Curl\Request;

class PaymentMethod extends AbstractService
{
    /**
     * @param $data
     *
     * @return array
     */
    public function createOne($data)
    {
        return $this
            ->run(
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
            ->run(
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
            ->run(
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
            ->run(
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
            ->run(
                'payment_methods',
                Request::METHOD_GET
            );
    }
}