<?php

namespace ISklep\Behat\Context;

use ISklep\API\LoggerInterface;

class InMemoryLogger implements LoggerInterface
{
    /**
     * @var array
     */
    protected static $logs = [];

    /**
     * @inheritdoc
     */
    public function log($level = '', $message = '', $context = [])
    {
        self::$logs[$level][$message] = $context;
    }

    /**
     * @param $level
     *
     * @return array
     */
    public function getLog($level)
    {
        if (isset(self::$logs[$level]) == FALSE) {
            return [];
        }

        return self::$logs[$level];
    }

    public function clear()
    {
        self::$logs = [];
    }
}