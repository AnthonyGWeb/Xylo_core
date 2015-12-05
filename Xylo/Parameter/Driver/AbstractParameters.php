<?php
namespace Xylo\Parameter\Driver;

use Xylo\Parameter\ParametersException;

abstract class AbstractParameters
{
    protected $parameters;
    /**
     * Check Parameters
     *
     * @param array $parameters
     * @param array $routeParameters
     * @return array
     * @throws ParametersException
     */
    protected function check(array $parameters, array $routeParameters)
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
                && preg_match('/^' . $routeParameters[$parameter] . '$/', $value) === 1
            ) {
                $returnParameters[$parameter] = $value;
                continue;
            }

            throw new ParametersException("Illegal parameters : " . $parameter . " value :" . var_export($value, true));
        }

        return $returnParameters;
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
