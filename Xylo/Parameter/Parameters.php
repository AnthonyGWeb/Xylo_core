<?php
namespace Xylo\Parameter;

use Xylo\Route\Route;
use Xylo\Server\Server;

class Parameters
{
    const GET = 'get';

    const POST = 'post';

    private $parameters = array();

    public function __construct(Route $router)
    {
        if (Server::getInstance()->request_method !== strtoupper($router->method)) {
            throw new ParametersException("Http method is invalid with settings");
        }

        switch ($router->method) {
            case self::POST:
                $this->retrievePost();
                break;
            case self::GET:
            default:
                // TODO retrieve get params
                break;
        }
    }

    private function check()
    {
        //TODO
    }

    private function retrievePost()
    {
        $retrieveParameters = explode('&', file_get_contents('php://input'));
        $parameters = array();
        foreach ($retrieveParameters as &$parameter) {
            $params = explode('=', $parameter);
            $parameters[$params[0]] = $params[1];
        }

        $this->parameters = $parameters;
    }

    /**
     * Return all parameters
     *
     * @return array
     */
    public function getAll()
    {
        return $this->parameters;
    }

    /**
     * Getter
     *
     * @param $parameter
     * @return mixed
     */
    public function __get($parameter)
    {
        return $this->parameters[$parameter];
    }
}
