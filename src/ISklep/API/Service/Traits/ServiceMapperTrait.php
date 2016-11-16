<?php

namespace ISklep\API\Service\Traits;

use ISklep\API\Mapper\MapperObjectInterface;

trait ServiceMapperTrait
{
    /**
     * @var MapperObjectInterface
     */
    protected $mapper;

    /**
     * @return MapperObjectInterface
     */
    public function getMapper()
    {
        return $this->mapper;
    }

    /**
     * @param MapperObjectInterface|null $mapper
     *
     * @return $this
     */
    public function setMapper(MapperObjectInterface $mapper = null)
    {
        if (!$mapper instanceof MapperObjectInterface) {
            $mapper = $this->getDefaultMapper();
        }

        $this->mapper = $mapper;

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasMapper()
    {
        return $this->getMapper() instanceof MapperObjectInterface;
    }

    /**
     * @return MapperObjectInterface
     */
    abstract public function getDefaultMapper();
}