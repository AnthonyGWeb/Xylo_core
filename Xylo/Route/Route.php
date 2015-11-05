<?php
namespace Xylo\Route;

use Xylo\Conf\Conf;
use Xylo\Logger\Logger;

class Route
{
    private $route;

    private $settings;

    private $routes = array();

    public function __construct()
    {
        $this->route = str_replace('?', '', $_SERVER['REQUEST_URI']); // Todo delete with rewriting is ok

        $routes = Conf::getConf('routing');
        foreach ($routes as $route) {
            $this->routes = array_merge($this->routes, json_decode(file_get_contents(ROOT_PATH . $route), true));
        }
    }

    public function loadRoute()
    {
        foreach ($this->routes as $nameOfRoute => $settings) {
            Logger::log('Route testing ' . $nameOfRoute, Logger::LOG_DEBUG);
            $pattern = preg_replace('/{[a-z]*}/', '.+', $settings['pattern']);
            var_dump(preg_replace('/\//', '\\/', $pattern), $this->route);
            if (preg_match('/' . preg_replace('/\//', '\\/', $pattern) . '/', $this->route) === 1) {
                Logger::log('Route match ' . $nameOfRoute, Logger::LOG_DEBUG);
                $this->settings = $settings;
                return $this->settings;
            }
        }
        Logger::log('No route match aborting ...', Logger::LOG_DEBUG);
        die; // Todo return 404 page
    }

    public function getSettings()
    {
        return $this->settings;
    }
}
