<?php
namespace Xylo\Server;

class Server
{
    private $server;

    private static $singleton;

    public function __construct()
    {
        $this->server = $_SERVER;
    }

    public function __get($param)
    {
        $param = strtoupper($param);
        return isset($this->server[$param]) ? $this->server[$param] : false ;
    }

    public static function getInstance()
    {
        if (self::$singleton instanceof Server) {
            return self::$singleton;
        }

        return self::$singleton = new Server();
    }
}
