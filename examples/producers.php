<?php

use ISklep\API\ClientFactory;
use ISklep\API\Credentials;
use ISklep\API\ServiceFactory;
use ISklep\API\Entity\Producer as ProducerEntity;
use ISklep\API\Mapper\ArrayToEntityMapper;
use ISklep\API\Mapper\EntityToArrayMapper;
use ISklep\Behat\Context\InMemoryLogger;

$host = 'host'; // set host

$credentials = (new Credentials())
    ->setUsername('user') // set user
    ->setPassword('pass') // set pass
;

// set up API client
$client = ClientFactory::create(
    $host,
    $credentials
);

// init producer service
$service = ServiceFactory::producer()
    ->setClient($client);

// return all producers, response is array like in doc
$response = $service->getAll();

/**
 * ---------------------------------------------------------------
 * MAPPING DATA array to entity
 */

$mapper = new ArrayToEntityMapper(
    ProducerEntity::class
);

// set up API client
$client = ClientFactory::create(
    $host,
    $credentials
);

// init producer service
$service = ServiceFactory::producer()
    ->setClient($client)
    ->setMapper($mapper);

$response = $service->createOne([
    'id' => 1129,
    'name' => 'test name',
    'ordering' => '2' // data will map automatically
]);


/**
 * ---------------------------------------------------------------
 * MAPPING DATA entity to array
 */

$mapper = new EntityToArrayMapper();

// set up API client
$client = ClientFactory::create(
    $host,
    $credentials
);

// init producer service
$service = ServiceFactory::producer()
    ->setClient($client)
    ->setMapper($mapper);

$producer = (new ProducerEntity())
    ->setId(1129)
    ->setName('test');

$response = $service->createOne($producer);

/**
 * You can write you own mapper it has to implement:
 * ISklep\API\Mapper::MapperObjectInterface
 */

/**
 * ---------------------------------------------------------------
 * LOGGING
 */

$logger = new InMemoryLogger();

// set up API client
$client = ClientFactory::create(
    $host,
    $credentials,
    $logger
);

/**
 * You can write you own logger it has to implement:
 * ISklep\API\LoggerInterface
 */
