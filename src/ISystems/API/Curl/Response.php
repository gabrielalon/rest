<?php

namespace ISystems\API\Curl;

class Response
{
    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $error;

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return Response
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     *
     * @return Response
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasError()
    {
        return empty($this->getError()) == false;
    }

    /**
     * @return array
     */
    public function getJsonBody()
    {
        return json_decode(
            $this->getBody(),
            true
        );
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'error' => $this->getError(),
            'body' => $this->getBody()
        ];
    }
}