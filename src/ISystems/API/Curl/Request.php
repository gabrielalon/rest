<?php

namespace ISystems\API\Curl;

class Request
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    /**
     * @var \ArrayObject
     */
    protected $options;

    /**
     * @var string
     */
    protected $contentType;

    public function __construct()
    {
        $this->initializeOptions();
    }

    protected function initializeOptions()
    {
        $this->options = new \ArrayObject();
    }

    /**
     * @return \ArrayObject
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $option
     * @param $value
     *
     * @return Request
     */
    public function addOption($option, $value)
    {
        $this
            ->getOptions()
            ->offsetSet($option, $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * @return array
     */
    public function getAvailableMethods()
    {
        return [
            self::METHOD_GET,
            self::METHOD_DELETE,
            self::METHOD_POST,
            self::METHOD_PUT
        ];
    }

    /**
     * @param string $url
     * @param string $method
     * @param string $data_string
     *
     * @return Response
     */
    public function send($url, $method, $data_string = '')
    {
        if (in_array($method, $this->getAvailableMethods()) == false) {
            throw new \InvalidArgumentException('Invalid method: ' . $method);
        }

        $ch = curl_init();
        $content_type = $this->getContentType();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: ' . ($content_type ? $content_type : 'application/json'),
            'Content-Length: ' . strlen($data_string)
        ]);

        foreach ($this->getOptions()->getArrayCopy() as $option => $value) {
            curl_setopt($ch, $option, $value);
        }

        $response = (new Response())
            ->setBody(curl_exec($ch))
            ->setError(curl_error($ch));

        curl_close($ch);
        return $response;
    }
}