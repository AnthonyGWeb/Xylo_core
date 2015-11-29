<?php

namespace Xylo\Application;

use Xylo\Route\Route;
use Xylo\View\View;

class Application
{
    private $router;

    private $view;

    /**
     * Initialise App
     */
    public function init()
    {
        $this->router = new Route();
        $this->router->loadSettings();
        $this->view = new View();
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

        $this->treatResponse(call_user_func($controller));
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
