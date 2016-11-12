<?php

namespace tests\unit\ISklep\API;

use ISklep\API\Client;
use ISklep\API\Credentials;
use ISklep\API\Curl\Request;
use ISklep\API\Curl\Response;
use ISklep\API\Exception;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Exception
     */
    public function testProcessException()
    {
        $host = 'test';
        $credentials = $this->getMockBuilder(Credentials::class)
            ->disableOriginalConstructor()
            ->setMethods(['getUsername', 'getPassword'])
            ->getMock();

        $request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->setMethods(['addOption', 'send'])
            ->getMock();

        $response = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->setMethods(['hasError'])
            ->getMock();

        $client = (new Client())
            ->setHost($host)
            ->setCredentials($credentials);

        $credentials
            ->expects($this->once())
            ->method('getUsername')
            ->willReturn(NULL)
        ;

        $credentials
            ->expects($this->once())
            ->method('getPassword')
            ->willReturn(false)
        ;

        $request->method('addOption')->willReturn($request);
        $request->method('send')->willReturn($response);

        $response->method('hasError')->willReturn(true);

        $client->process('status', Request::METHOD_GET);
    }
}