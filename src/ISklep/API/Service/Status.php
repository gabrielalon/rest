<?php

namespace ISklep\API\Service;

use ISklep\API\Curl\Request;

class Status extends AbstractService
{
    /**
     * @return array
     */
    public function getStatus()
    {
        return $this
            ->run(
                'status',
                Request::METHOD_GET
            );
    }
}