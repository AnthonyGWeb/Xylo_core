<?php
namespace Xylo\Route;

use Xylo\Conf\Conf;
use Xylo\Logger\Logger;

class Route
{
    private $route;

    private $settings = array();

    private $routes = array();

    public function __construct()
    {
        $search = array('/index.php', '?');
        $this->route = str_replace($search, '', $_SERVER['REQUEST_URI']);

        $routes = Conf::getConf('routing');
        foreach ($routes as $route) {
            $this->routes = array_merge($this->routes, json_decode(file_get_contents(ROOT_PATH . $route), true));
        }
    }

    /**
     * Load settings of route
     *
     * @return bool
     */
    public function loadSettings()
    {

        foreach ($this->routes as $nameOfRoute => $settings) {
            Logger::log('Route testing ' . $nameOfRoute, Logger::LOG_DEBUG);
            $pattern = preg_replace('/{[a-z]*}/', '.+', $settings['pattern']);
            if (preg_match('/^' . preg_replace('/\//', '\\/', $pattern) . '$/', $this->route) === 1) {
                Logger::log('Route matching with ' . $nameOfRoute, Logger::LOG_DEBUG);
                $this->settings = $settings;
                return true;
            }
        }
        Logger::log('No route match aborting ...', Logger::LOG_DEBUG);

        header('Location: /404.html');
        die;
    }

//    public function getSettings()
//    {
//        return $this->settings;
//    }

    /**
     * Getter
     *
     * @param $nameOfParameters
     * @return mixed
     */
    public function __get($nameOfParameters)
    {
        return $this->settings[$nameOfParameters];
    }
}
