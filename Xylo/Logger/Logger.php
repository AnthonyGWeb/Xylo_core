<?php
namespace Xylo\Logger;

class Logger
{
    const LOG_DEBUG = 0;
    const LOG_INFO = 1;
    const LOG_ERROR = 2;
    const LOG_CRITICAL = 3;

    public function log($message, $logLevel = self::LOG_INFO)
    {
        // Todo write in different file or logs
    }
}
