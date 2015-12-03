<?php
namespace Xylo\Parameter\Driver;

use Xylo\Parameter\ParametersException;
use Xylo\Route\Route;

class ParametersPost implements ParametersDriver
{
    private $parameters;

    public function __construct()
    {
        $this->check($this->retrievePost());
    }

    /**
     * Check parameters
     *
     * @param array $parameters
     * @throws ParametersException
     */
    private function check(array $parameters)
    {
        $parametersRoute = Route::getInstance()->parameters;
        foreach ($parameters as $parameter => $value) {
            if (
                !isset($parametersRoute[$parameter])
                || preg_match('/' . $parametersRoute[$parameter] . '/', $value) !== 1
            ) {
                throw new ParametersException("Illegal parameters : " . $parameter . " value :" . $value);
            }
        }
        $this->parameters = $parameters;
    }

    /**
     * Retrieve parameters post
     *
     * @return array
     */
    private function retrievePost()
    {
        $retrieveParameters = explode('&', file_get_contents('php://input'));
        $parameters = array();
        foreach ($retrieveParameters as &$parameter) {
            $params = explode('=', $parameter);
            $parameters[$params[0]] = $params[1];
        }

        return $parameters;
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

    /**
     * Return all parameters
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->parameters;
    }
}
