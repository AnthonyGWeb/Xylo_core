<?php

namespace Xylo\Application;

use Xylo\Conf\Conf;
use Xylo\Route\Route;

class Application
{
    public function run()
    {
        Conf::loadApps();

        $router = new Route();
        $router->loadRoute();
    }
}
