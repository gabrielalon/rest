<?php

namespace ISklep\Behat\Context\Traits;

use Behat\Gherkin\Node\TableNode;
use ISklep\API\Entities\PaymentMethod;
use ISklep\API\Mapper\ArrayToEntityMapper;
use ISklep\API\Mapper\MapperObjectInterface;
use ISklep\API\ServiceFactory;
use ISklep\API\Service\PaymentMethod as Service;
use PHPUnit_Framework_Assert as Asserts;

trait PaymentMethodTrait
{
    /**
     * @param MapperObjectInterface $mapper
     *
     * @return Service
     */
    public function getPaymentMethodService($mapper = null)
    {
        return ServiceFactory::paymentMethod()
            ->setClient($this->getClient())
            ->setMapper($mapper);
    }

    /**
     * @Then I send request for all payment methods
     */
    public function getAllPaymentMethods()
    {
        try {
             $this
                ->getPaymentMethodService()
                ->getAll();
        } catch (\Exception $e) {
            Asserts::fail($e->getMessage());
        }
    }

    /**
     * @Then I send request for all payment methods and map data
     */
    public function getAllMappedPaymentMethods()
    {
        $mapper = new ArrayToEntityMapper(
            PaymentMethod::class
        );

        try {
            $response = $this
                ->getPaymentMethodService($mapper)
                ->getAll();
        } catch (\Exception $e) {
            Asserts::fail($e->getMessage($mapper));
        }

        Asserts::assertInstanceOf(PaymentMethod::class, current($response),
            'Response does not have PaymentMethod entity');
    }

    /**
     * @Then I send POST payment_method object with data:
     *
     * @param TableNode $table
     */
    public function createPaymentMethodWithObject(TableNode $table)
    {
        $data = $table->getColumnsHash();
        $payM = (new PaymentMethod())
            ->setId($data[0]['id'])
            ->setAdditionalInfo($data[0]['additional_info'])
            ->setEmailBody($data[0]['email_body'])
            ->setIsActive($data[0]['is_active'])
            ->setIsPaidAtDeliveryTime($data[0]['is_paid_at_delivery_time'])
            ->setName($data[0]['name'])
            ->setOrdering($data[0]['ordering'])
            ->setPluginId($data[0]['plugin_id']);

        try {
            $response = $this
                ->getPaymentMethodService()
                ->createOne($payM);
        } catch (\Exception $e) {
            Asserts::fail($e->getMessage());
        }

        Asserts::assertArrayHasKey('name', $response,
            'Response does not have name.');
        Asserts::assertEquals($payM->getName(), $response['name'],
            'PaymentMethod does not have same name.');
    }

    /**
     * @Then I send POST payment_method array with data:
     *
     * @param TableNode $table
     */
    public function createPaymentMethodWithArray(TableNode $table)
    {
        $data = $table->getColumnsHash()[0];
        $mapper = new ArrayToEntityMapper(
            PaymentMethod::class
        );

        try {
            $response = $this
                ->getPaymentMethodService($mapper)
                ->createOne($data);
        } catch (\Exception $e) {
            Asserts::fail($e->getMessage());
        }

        Asserts::assertInstanceOf(PaymentMethod::class, $response,
            'Response does not have PaymentMethod entity object.');
        Asserts::assertEquals($data['name'], $response->getName(),
            'PaymentMethod does not have same name.');
    }
}