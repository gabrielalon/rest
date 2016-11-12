<?php

namespace ISystems\API\Mappers;

use ISystems\API\Mappers\Traits\MapperObjectTrait;

class EntityToArrayMapper implements
    MapperObjectInterface
{
    use MapperObjectTrait;

    /**
     * @inheritdoc
     */
    public function onRequest($data)
    {
        return $this->entityToArray(
            $this->transfer($data)
        );
    }

    /**
     * @inheritdoc
     */
    public function onResponse($data = [])
    {
        return array_map(
            array($this, 'transfer'),
            $data
        );
    }

    /**
     * @inheritdoc
     */
    public function transfer($data)
    {
        return $data;
    }
}