<?php
namespace Xylo\Parameter;

use Xylo\Parameter\Driver\ParametersGet;
use Xylo\Parameter\Driver\ParametersPost;
use Xylo\Route\Route;
use Xylo\Server\Server;

class Parameters
{
    const GET = 'GET';

    const POST = 'POST';

    private static $instanceOfParameters;

    private function __construct()
    {

    }

    private static function getInstanceDriver()
    {
        $method = Server::getInstance()->request_method;
        if (strtoupper(Route::getInstance()->method) === $method) {
            switch ($method) {
                case self::POST:
                    return new ParametersPost();
                    break;
                case self::GET:
                    return new ParametersGet();
                    break;
                default:
                    throw new ParametersException("Invalid http request method");
                    break;
            }
        }

        throw new ParametersException("Request method in route settings is different of http request");
    }

    /**
     * @return Parameters
     */
    public static function getInstance()
    {
        if (self::$instanceOfParameters instanceof Parameters) {
            return self::$instanceOfParameters;
        }

        return self::$instanceOfParameters = self::getInstanceDriver();
    }
}
