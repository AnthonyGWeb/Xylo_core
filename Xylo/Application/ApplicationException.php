<?php
namespace Xylo\Application;

use Xylo\Logger\Logger;

class ApplicationException extends \Exception
{
    public function log()
    {
        Logger::log('Applicaton exception : ' . $this->getMessage());
    }
}
