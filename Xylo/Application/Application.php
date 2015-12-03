<?php

namespace Xylo\Application;

use Xylo\Parameter\Parameters;
use Xylo\Route\Route;
use Xylo\View\View;

class Application
{
    /**
     * @var $router | instance of Router
     */
    private $router;

    /**
     * @var $view | instance of View
     */
    private $view;

    /**
     * @var $parameters | instance of Parameters
     */
    private $parameters;

    /**
     * Initialise App
     */
    public function init()
    {
        $this->router = Route::getInstance();
        $this->router->loadSettings();
        $this->view = new View();
        $this->parameters = Parameters::getInstance();
    }

    /**
     * @throws ApplicationException
     */
    public function run()
    {
        $controller = $this->router->controller;
        if (!isset($controller)) {
            throw new ApplicationException("Controller settings is not found");
        }

        $this->treatResponse(call_user_func($controller, $this->parameters));
    }

    /**
     * @param $response
     */
    private function treatResponse($response = false)
    {
        if ($response !== false && is_array($response)) {
            $params = isset($response['params']) ? $response['params'] : array();
            $this->view->callView($response['template'], $params);
        }
    }

    /**
     *
     */
    public function executePreCallPlugins()
    {
        // TODO session
    }

    /**
     *
     */
    public function executePostCallPlugins()
    {

    }
}
