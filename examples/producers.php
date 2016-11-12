<?php

use ISystems\API\ClientFactory;
use ISystems\API\Credentials;
use ISystems\API\ServiceFactory;
use ISystems\API\Entities\Producer as ProducerEntity;
use ISystems\API\Mappers\ArrayToEntityMapper;
use ISystems\API\Mappers\EntityToArrayMapper;
use ISystems\Monolog\InMemoryLogger;

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
$service = ServiceFactory::producer($client);

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
    $credentials,
    $mapper
);

// init producer service
$service = ServiceFactory::producer($client);

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
    $credentials,
    $mapper
);

// init producer service
$service = ServiceFactory::producer($client);

$producer = (new ProducerEntity())
    ->setId(1129)
    ->setName('test');

$response = $service->createOne($producer);

/**
 * You can write you own mapper it has to implement:
 * ISystems\API\Mappers::MapperObjectInterface
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
    null,
    $logger
);

/**
 * You can write you own logger it has to implement:
 * ISystems\Monolog\LoggerInterface
 */
