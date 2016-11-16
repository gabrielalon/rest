<?php

namespace ISklep\API;

use ISklep\API\Curl\Request;
use ISklep\API\Curl\Response;

class Client
{
    const HOST_SUFFIX = 'rest_api/shop_api/v1';

    /**
     * @var string
     */
    protected $host;

    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @return Credentials
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @param Credentials $credentials
     *
     * @return Client
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;

        return $this;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     *
     * @return Client
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface|null $logger
     *
     * @return Client
     */
    public function setLogger($logger = null)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasLogger()
    {
        return $this->getLogger() instanceof LoggerInterface;
    }

    /**
     * @return Request
     */
    protected function prepareRequest()
    {
        $credentials = $this->getCredentials();

        return (new Request())
            ->addOption(CURLOPT_FOLLOWLOCATION, true)
            ->addOption(CURLOPT_RETURNTRANSFER, true)
            ->addOption(CURLOPT_HTTPAUTH, CURLAUTH_ANY)
            ->addOption(CURLOPT_USERPWD, sprintf(
                '%s:%s',
                $credentials->getUsername(),
                $credentials->getPassword()
            ));
    }

    /**
     * @return string
     */
    protected function prepareUrl()
    {
        return sprintf(
            'http://%s/%s/',
            $this->getHost(),
            self::HOST_SUFFIX
        );
    }

    /**
     * @param string $query
     * @param string $method
     * @param array  $data
     *
     * @return array
     */
    public function send($query, $method, array $data = [])
    {
        $data_string = json_encode($data);

        // logging the request
        $this->handleLog($query . '::request', $data_string);

        // send data
        $request = $this->prepareRequest();
        $response = $request->send(
            $this->prepareUrl() . $query,
            $method,
            $data_string
        );

        // logging the response
        $this->handleLog($query . '::response', $response->toArray());

        // validate response
        $this->validateResponse($response);

        $source = $response->getJsonBody();
        return current($source['data']);
    }

    /**
     * @param Response $response
     */
    protected function validateResponse(Response $response)
    {
        if ($response->hasError()) {
            throw new Exception(
                $response->getError()
            );
        }

        $source = $response->getJsonBody();

        // there were some errors
        if ($source['success'] == false) {
            throw new Exception(
                implode(chr(10), $source['error']['messages']),
                $source['error']['reason_code']
            );
        }
    }

    /**
     * @param string $query
     * @param array  $context
     */
    protected function handleLog($query, $context = [])
    {
        if ($this->hasLogger() == true) {
            $this->getLogger()
                ->log(
                    'info',
                    __CLASS__ . '::' . $query,
                    $context
                );
        }
    }
}