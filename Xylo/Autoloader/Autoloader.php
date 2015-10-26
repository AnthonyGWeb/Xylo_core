<?php
namespace Xylo\Autoloader;

class Autoloader
{
    /**
     * Call autoload
     */
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }


    /**
     * Require class when call
     *
     * @param $class
     */
    public static function autoload($class)
    {
        $class = str_replace('\\', '/', $class); // Todo Write autoload for all namespace
        require_once ROOT_PATH . '/' . $class . '.php';
    }
}
