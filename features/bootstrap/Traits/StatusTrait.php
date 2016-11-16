<?php

namespace ISklep\Behat\Context\Traits;

use ISklep\API\ServiceFactory;
use ISklep\API\Service\Status;
use PHPUnit_Framework_Assert as Asserts;

trait StatusTrait
{
    /**
     * @return Status
     */
    public function getStatusService()
    {
        return ServiceFactory::status()
            ->setClient($this->getClient());
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

        Asserts::assertArrayHasKey('userLogin', $response,
            'Response does not have userLogin.');
        Asserts::assertEquals($this->getCredentials()->getUsername(), $response['userLogin'],
            'Response does not have valid user.');
    }
}