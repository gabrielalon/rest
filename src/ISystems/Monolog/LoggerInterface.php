<?php

namespace ISystems\Monolog;

interface LoggerInterface
{
    /**
     * @param string $level
     * @param string $message
     * @param array  $context
     */
    public function log($level = '', $message = '', $context = []);
}