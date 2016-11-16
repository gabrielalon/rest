<?php

namespace ISklep\API\Mapper;

use ISklep\API\Mapper\Traits\MapperObjectTrait;

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
        if ($this->isCollection($data)) {
            return array_map(
                array($this, 'transfer'),
                $data
            );
        }

        return $this->transfer($data);
    }

    /**
     * @inheritdoc
     */
    public function transfer($data)
    {
        return $data;
    }
}