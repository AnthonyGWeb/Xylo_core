<?php
namespace Xylo\Parameter\Driver;

use Xylo\Route\Route;
use Xylo\Server\Server;

class ParametersGet extends AbstractParameters
{
    public function __construct()
    {
        $this->retrieveGet();
    }

    /**
     * Retrieve parameters post
     */
    private function retrieveGet()
    {
        $uriInfos = explode('/', str_replace('/index.php/', '', Server::getInstance()->request_uri));
        $test = explode('/', substr(Route::getInstance()->pattern, 1));

        $parameters = array();
        for ($i = 0, $len = count($test); $i < $len; $i++) {
            if ($uriInfos[$i] !== $test[$i]) {
                $parameters[substr($test[$i], 1, -1)] = $uriInfos[$i];
            }
        }

        $this->parameters = $this->check($parameters, Route::getInstance()->parameters);
    }
}
