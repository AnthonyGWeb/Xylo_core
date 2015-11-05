<?php

namespace Xylo\Application;

use Xylo\Conf\Conf;
use Xylo\Route\Route;

class Application
{
    private $router;

    private $globalSettings;

    /**
     * Initialise app
     */
    public function init()
    {
        $this->globalSettings = Conf::loadApps();

        $this->router = new Route();
        $this->router->loadRoute();
    }

    public function run()
    {

    }
}
