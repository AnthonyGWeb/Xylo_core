<?php
namespace Xylo\Logger;

class Logger
{
    const LOG_DEBUG = 0;
    const LOG_INFO = 1;
    const LOG_ERROR = 2;
    const LOG_CRITICAL = 3;

    public static function log($message, $logLevel = self::LOG_INFO)
    {
        switch ($logLevel) {
            case self::LOG_DEBUG:
                $logLevelString = 'DEBUG';
                break;
            case self::LOG_INFO:
                $logLevelString = 'INFO';
                break;
            case self::LOG_ERROR:
                $logLevelString = 'ERROR';
                break;
            case self::LOG_CRITICAL:
                $logLevelString = 'CRITICAL';
                break;
            default:
                //todo exception
        }
        $error = "[$logLevelString] $message";
        error_log($error);
    }
}
