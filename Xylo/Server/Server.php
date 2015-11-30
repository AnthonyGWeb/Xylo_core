<?php
namespace Xylo\Server;

class Server
{
    private $server;

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
        return new Server();
    }
}
