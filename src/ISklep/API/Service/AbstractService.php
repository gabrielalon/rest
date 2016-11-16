<?php

namespace ISklep\API\Service;

use ISklep\API\Mapper\EntityToArrayMapper;
use ISklep\API\Service\Traits\ServiceClientTrait;
use ISklep\API\Service\Traits\ServiceMapperTrait;

abstract class AbstractService implements ServiceObjectInterface
{
    use ServiceClientTrait;
    use ServiceMapperTrait;

    /**
     * @return EntityToArrayMapper
     */
    public function getDefaultMapper()
    {
        return new EntityToArrayMapper();
    }

    /**
     * @param string $query
     * @param string $method
     * @param array  $data
     *
     * @return array
     */
    public function run($query, $method, $data = [])
    {
        if (!empty($data) && $this->hasMapper()) {
            // map data on request
            $data = $this->getMapper()
                ->onRequest($data);
        }

        $result = $this->getClient()
            ->send($query, $method, $data);

        if ($result && $this->hasMapper()) {
            // map data on response
            $result = $this->getMapper()
                ->onResponse($result);
        }

        return $result;
    }
}