<?php
namespace Xylo\Parameter\Driver;

use Xylo\Parameter\ParametersException;
use Xylo\Route\Route;

class ParametersPost implements ParametersDriver
{
    private $parameters;

    public function __construct()
    {
        $this->retrievePost();
    }

    /**
     * Check Parameters
     *
     * @param array $parameters
     * @param array $routeParameters
     * @return array
     * @throws ParametersException
     */
    private function check(array $parameters, array $routeParameters)
    {
        $returnParameters = array();
        foreach ($parameters as $parameter => $value) {
            if (is_array($value) && isset($routeParameters[$parameter])) {
                if (is_array($routeParameters[$parameter])) {
                    $returnParameters[$parameter] = $this->check($value, $routeParameters[$parameter]);
                    continue;
                }
            } elseif (
                isset($routeParameters[$parameter])
                && preg_match('/' . $routeParameters[$parameter] . '/', $value) === 1
            ) {
                $returnParameters[$parameter] = $value;
                continue;
            }

            throw new ParametersException("Illegal parameters : " . $parameter . " value :" . var_export($value, true));
        }

        return $returnParameters;
    }

    /**
     * Retrieve parameters post
     */
    private function retrievePost()
    {
        $parameters = array();
        parse_str(file_get_contents('php://input'), $parameters);

        $this->parameters = $this->check($parameters, Route::getInstance()->parameters);
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
