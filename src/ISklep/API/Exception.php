<?php

namespace ISklep\API;

class Exception extends \RuntimeException
{
    const INTERNAL_SERVER_ERROR = 'internal_server_error';
    const API_NOT_FOUND = 'api_not_found';
    const API_VERSION_NOT_FOUND = 'api_version_not_found';
    const ROUTE_NOT_FOUND_OR_METHOD_NOT_ALLOWED = 'route_not_found_or_method_not_allowed';
    const UNAUTHORIZED = 'unauthorized';
    const MALFORMED_REQUEST_BODY = 'malformed_request_body';
    const RESOURCE_NOT_FOUND = 'resource_not_found';
    const INVALID_LANG_CODE_IN_QUERY_STRING = 'invalid_lang_code_in_query_string';
    const INVALID_REQUEST_DATA = 'invalid_request_data';
    const INVALID_DATA_FOR_OBJECT = 'invalid_data_for_object';

    /**
     * @param string          $message
     * @param int             $code
     * @param \Exception|NULL $previous
     */
    public function __construct($message, $code = 0, \Exception $previous = NULL)
    {
        parent::__construct($message, $this->mapCode($code), $previous);
    }

    /**
     * @param $code
     *
     * @return integer
     */
    protected function mapCode($code)
    {
        $codes = [
            self::API_NOT_FOUND => 900,
            self::API_VERSION_NOT_FOUND => 901,
            self::INTERNAL_SERVER_ERROR => 902,
            self::INVALID_DATA_FOR_OBJECT => 903,
            self::INVALID_LANG_CODE_IN_QUERY_STRING => 904,
            self::INVALID_REQUEST_DATA => 905,
            self::MALFORMED_REQUEST_BODY => 906,
            self::RESOURCE_NOT_FOUND => 907,
            self::ROUTE_NOT_FOUND_OR_METHOD_NOT_ALLOWED => 908,
            self::UNAUTHORIZED => 909
        ];

        $code = strtolower($code);
        if (isset($codes[$code])) {
            return $codes[$code];
        }

        return $code;
    }
}