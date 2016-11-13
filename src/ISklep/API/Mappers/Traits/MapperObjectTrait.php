<?php

namespace ISklep\API\Mappers\Traits;

use ISklep\API\Entities\EntityObjectInterface;

trait MapperObjectTrait
{
    /**
     * @param EntityObjectInterface $entity
     *
     * @return array
     */
    protected function entityToArray(EntityObjectInterface $entity)
    {
        $data = [];

        $reflection = new \ReflectionClass($entity);
        $properties = $reflection->getProperties(
            \ReflectionProperty::IS_PROTECTED
        );

        /** @var \ReflectionProperty $property */
        foreach ($properties as $property) {
            $method = sprintf('get%s', $this->camelize(
                $property->getName(),
                true
            ));

            if ($reflection->hasMethod($method) == false) {
                throw new \RuntimeException(sprintf(
                    'Entity %s does not have method %s',
                    $reflection->getName(),
                    $method
                ));
            }

            $value = $entity->$method();
            if (is_null($value) == true) {
                // skip null values
                continue;
            }

            $data[ $this->uncamelize($property->getName()) ] = $value;
        }

        return [$entity->getField() => $data];
    }

    /**
     * @param string $entity_class
     * @param array  $data
     *
     * @return EntityObjectInterface
     */
    protected function arrayToEntity($entity_class, $data = [])
    {
        $reflection = new \ReflectionClass($entity_class);

        $interface = EntityObjectInterface::class;
        if ($reflection->implementsInterface($interface) == false) {
            throw new \RuntimeException(sprintf(
                'Entity %s does not implement %s',
                $reflection->getName(),
                $interface
            ));
        }

        /** @var EntityObjectInterface $entity */
        $entity = $reflection->newInstance();
        $properties = $reflection->getProperties(
            \ReflectionProperty::IS_PROTECTED
        );

        /** @var \ReflectionProperty $property */
        foreach ($properties as $property) {
            $method = sprintf('set%s', $this->camelize(
                $property->getName(),
                true
            ));

            if ($reflection->hasMethod($method) == false) {
                throw new \RuntimeException(sprintf(
                    'Entity %s does not have method %s',
                    $reflection->getName(),
                    $method
                ));
            }

            $key = $this->uncamelize($property->getName());
            if (isset($data[$key]) == false) {
                // skip not set
                continue;
            }

            $value = $data[$key];
            $entity->$method($value);
        }

        return $entity;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function isCollection($data = [])
    {
        $value = current($data);
        return is_array($value);
    }

    /**
     * @param string $string
     * @param bool   $capitalizeFirstCharacter
     *
     * @return string
     */
    private function camelize($string, $capitalizeFirstCharacter = false)
    {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    /**
     * @param string $camel
     * @param string $splitter
     *
     * @return string
     */
    private function uncamelize($camel, $splitter = "_")
    {
        $camel = preg_replace(
            '/(?!^)[[:upper:]][[:lower:]]/',
            '$0',
            preg_replace(
                '/(?!^)[[:upper:]]+/',
                $splitter . '$0',
                $camel
            )
        );

        return strtolower($camel);

    }
}