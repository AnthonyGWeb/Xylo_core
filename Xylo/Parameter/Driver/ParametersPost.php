<?php
namespace Xylo\Parameter\Driver;

use Xylo\Route\Route;

class ParametersPost extends AbstractParameters
{
    public function __construct()
    {
        $this->retrievePost();
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
}
