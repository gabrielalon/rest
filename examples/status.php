<?php

use ISklep\API\ClientFactory;
use ISklep\API\Credentials;
use ISklep\API\ServiceFactory;

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

// init status service
$status = ServiceFactory::status()
    ->setClient($client);

// call gate
$response = $status->getStatus(); // response is array like in doc