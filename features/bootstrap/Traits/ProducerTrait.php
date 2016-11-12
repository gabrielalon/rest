<?php

namespace ISystems\Behat\Context\Traits;

use Behat\Gherkin\Node\TableNode;
use ISystems\API\Entities\Producer;
use ISystems\API\Mappers\MapperObjectInterface;
use ISystems\API\ServiceFactory;
use ISystems\API\Services\Producer as Service;
use ISystems\API\Mappers\ArrayToEntityMapper;
use PHPUnit_Framework_Assert as Asserts;

trait ProducerTrait
{
    /**
     * @param MapperObjectInterface $mapper
     *
     * @return Service
     */
    public function getProducerService($mapper = null)
    {
        return ServiceFactory::producer(
            $this->getClient($mapper)
        );
    }

    /**
     * @Then I send request for all producers
     */
    public function getAllProducers()
    {
        try {
            $response = $this
                ->getProducerService()
                ->getAll();
        } catch (\Exception $e) {
            Asserts::fail($e->getMessage());
        }

        Asserts::assertArrayHasKey('data', $response,
            'Response does not have data.');
        Asserts::assertArrayHasKey('producers', $response['data'],
            'Response does not have producer entity.');
    }

    /**
     * @Then I send POST producer object with data:
     *
     * @param TableNode $table
     */
    public function createProducerWithObject(TableNode $table)
    {
        $data = $table->getColumnsHash();
        $prod = (new Producer())
            ->setId($data[0]['id'])
            ->setSourceId(str_shuffle($data[0]['source_id']))
            ->setLogoFilename($data[0]['logo_filename'])
            ->setName($data[0]['name'])
            ->setOrdering($data[0]['ordering'])
            ->setSiteUrl($data[0]['site_url']);

        try {
            $response = $this
                ->getProducerService()
                ->createOne($prod);
        } catch (\Exception $e) {
            Asserts::fail($e->getMessage());
        }

        Asserts::assertArrayHasKey('data', $response,
            'Response does not have data.');
        Asserts::assertArrayHasKey('producer', $response['data'],
            'Response does not have producer entity.');
    }

    /**
     * @Then I send POST producer array with data:
     *
     * @param TableNode $table
     */
    public function createProducerWithArray(TableNode $table)
    {
        $data = $table->getColumnsHash()[0];
        $data['source_id'] = str_shuffle($data['source_id']);

        $mapper = new ArrayToEntityMapper(
            Producer::class
        );

        try {
            $response = $this
                ->getProducerService($mapper)
                ->createOne($data);
        } catch (\Exception $e) {
            Asserts::fail($e->getMessage());
        }

        Asserts::assertArrayHasKey('data', $response,
            'Response does not have data.');
        Asserts::assertArrayHasKey('producer', $response['data'],
            'Response does not have producer entity.');
        Asserts::assertInstanceOf(Producer::class, $response['data']['producer'],
            'Response does not have producer entity object.');
    }
}