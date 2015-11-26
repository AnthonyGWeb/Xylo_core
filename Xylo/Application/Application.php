<?php

namespace Xylo\Application;

use Xylo\Conf\Conf;
use Xylo\Route\Route;

class Application
{
    private $router;

    private $globalSettings;

    /**
     * Initialise Portfolio
     */
    public function init()
    {
        $this->globalSettings = Conf::loadApps();

        $this->router = new Route();
        $this->router->loadSettings();
    }

    public function run()
    {
        $settings = $this->router->getSettings();
        // Todo secure var settings
//        $controllers = explode('::', $settings['controller']);
//        var_dump($controllers);
        $this->treatResponse(call_user_func($settings['controller']));

    }

    private function treatResponse(Array $response)
    {
        var_dump($response);
    }
}
