<?php

namespace ISklep\Behat\Context\Traits;

use ISklep\API\ServiceFactory;
use ISklep\API\Services\Status;
use PHPUnit_Framework_Assert as Asserts;

trait StatusTrait
{
    /**
     * @return Status
     */
    public function getStatusService()
    {
        return ServiceFactory::status(
            $this->getClient()
        );
    }

    /**
     * @Then I send request for status
     */
    public function getStatus()
    {
        try {
            $response = $this
                ->getStatusService()
                ->getStatus();
        } catch (\Exception $e) {
            Asserts::fail($e->getMessage());
        }

        Asserts::assertArrayHasKey('data', $response,
            'Response does not have data.');
        Asserts::assertArrayHasKey('status', $response['data'],
            'Response does not have producer entity.');
    }
}