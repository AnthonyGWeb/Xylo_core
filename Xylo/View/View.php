<?php
namespace Xylo\View;

use Xylo\Conf\Conf;
use Xylo\View\Driver\TwigDriver;

class View
{
    const TWIG = 'twig';

    const TYPE_JSON = 'json';

    private $driver;

    public function __construct()
    {
        $driver = Conf::getConf('view.driver');
        switch ($driver) {
            case self::TWIG:
                $this->driver = new TwigDriver();
                break;
            default:
                throw new ViewException("Views driver is undefined : $driver");
                break;
        }
    }

    public function callView($template, array $params = null)
    {
        $this->driver->displayResponse($template, $params);
    }

    public static function formatResponse($type, array $params)
    {
        switch ($type) {
            case self::TYPE_JSON:
                header('Content-Type: application/json');
                echo json_encode($params, true);
                break;
            default:
                throw new ViewException("The view type is undefined : $type");
                break;
        }

        return false;
    }
}
