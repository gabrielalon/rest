<?php

namespace ISklep\API\Mappers;

use ISklep\API\Entities\EntityObjectInterface;

interface MapperObjectInterface
{
    /**
     * @param mixed $data
     *
     * @return array
     */
    public function onRequest($data);

    /**
     * @param array $data
     *
     * @return object
     */
    public function onResponse($data = []);

    /**
     * @param mixed $data
     *
     * @return EntityObjectInterface
     */
    public function transfer($data);
}