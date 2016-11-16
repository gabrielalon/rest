<?php

namespace ISklep\Behat\Context\Traits;

use Behat\Gherkin\Node\TableNode;
use ISklep\API\Entity\Producer;
use ISklep\API\Mapper\MapperObjectInterface;
use ISklep\API\ServiceFactory;
use ISklep\API\Service\Producer as Service;
use ISklep\API\Mapper\ArrayToEntityMapper;
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
        return ServiceFactory::producer()
            ->setClient($this->getClient())
            ->setMapper($mapper);
    }

    /**
     * @Then I send request for all producers
     */
    public function getAllProducers()
    {
        try {
             $this
                ->getProducerService()
                ->getAll();
        } catch (\Exception $e) {
            Asserts::fail($e->getMessage());
        }
    }

    /**
     * @Then I send request for all producers and map data
     */
    public function getAllMappedProducers()
    {
        $mapper = new ArrayToEntityMapper(
            Producer::class
        );

        try {
            $response = $this
                ->getProducerService($mapper)
                ->getAll();
        } catch (\Exception $e) {
            Asserts::fail($e->getMessage());
        }

        Asserts::assertInstanceOf(Producer::class, current($response),
            'Response does not have Producer entity');
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

        Asserts::assertArrayHasKey('name', $response,
            'Response does not have name.');
        Asserts::assertEquals($prod->getName(), $response['name'],
            'Producer does not have same name.');
    }

    /**
     * @Then I send spoiled POST producer object with data:
     *
     * @param TableNode $table
     */
    public function createSpoiledProducerWithObject(TableNode $table)
    {
        $data = $table->getColumnsHash();
        $prod = (new Producer())
            ->setId($data[0]['id'])
            ->setSourceId($data[0]['source_id'])
            ->setLogoFilename($data[0]['logo_filename'])
            ->setName($data[0]['name'])
            ->setOrdering($data[0]['ordering'])
            ->setSiteUrl($data[0]['site_url']);

        try {
            $this
                ->getProducerService()
                ->createOne($prod);
        } catch (\Exception $e) {}
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

        Asserts::assertInstanceOf(Producer::class, $response,
            'Response does not have producer entity object.');
        Asserts::assertEquals($data['name'], $response->getName(),
            'Producer does not have same name.');
    }
}