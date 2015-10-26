<?php

namespace Xylo\Application;

use Xylo\Conf\Conf;
use Xylo\Route\Route;

class Application
{
    private $router;

    public function init()
    {
        Conf::loadApps();

        $this->router = new Route();
        //$this->router->loadRoute();
    }

    public function run()
    {

    }
}
