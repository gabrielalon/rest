<?php

namespace ISklep\Behat\Context\Traits;

use Behat\Gherkin\Node\TableNode;
use ISklep\API\Entities\PaymentMethod;
use ISklep\API\Mappers\ArrayToEntityMapper;
use ISklep\API\Mappers\MapperObjectInterface;
use ISklep\API\ServiceFactory;
use ISklep\API\Services\PaymentMethod as Service;
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
        return ServiceFactory::paymentMethod(
            $this->getClient($mapper)
        );
    }

    /**
     * @Then I send request for all payment methods
     */
    public function getAllPaymentMethods()
    {
        try {
            $response = $this
                ->getPaymentMethodService()
                ->getAll();
        } catch (\Exception $e) {
            Asserts::fail($e->getMessage());
        }

        Asserts::assertArrayHasKey('data', $response,
            'Response does not have data.');
        Asserts::assertArrayHasKey('payment_methods', $response['data'],
            'Response does not have payment_method entity.');
    }

    /**
     * @Then I send POST payment_method object with data:
     *
     * @param TableNode $table
     */
    public function createPaymentMethodWithObject(TableNode $table)
    {
        $data = $table->getColumnsHash();
        $prod = (new PaymentMethod())
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
                ->createOne($prod);
        } catch (\Exception $e) {
            Asserts::fail($e->getMessage());
        }

        Asserts::assertArrayHasKey('data', $response,
            'Response does not have data.');
        Asserts::assertArrayHasKey('payment_method', $response['data'],
            'Response does not have payment_method entity.');
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

        Asserts::assertArrayHasKey('data', $response,
            'Response does not have data.');
        Asserts::assertArrayHasKey('payment_method', $response['data'],
            'Response does not have payment_method entity.');
        Asserts::assertInstanceOf(PaymentMethod::class, $response['data']['payment_method'],
            'Response does not have payment_method entity object.');
    }
}