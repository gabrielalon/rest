<?php

namespace ISklep\API\Mapper;

class ArrayToEntityMapper extends EntityToArrayMapper
{
    /**
     * @var string
     */
    protected $entityClass;

    /**
     * @param $entity_class
     */
    public function __construct($entity_class)
    {
        $this->setEntityClass($entity_class);
    }

    /**
     * @return string
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * @param string $entityClass
     *
     * @return ArrayToEntityMapper
     */
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function transfer($data)
    {
        return $this->arrayToEntity(
            $this->getEntityClass(),
            $data
        );
    }
}