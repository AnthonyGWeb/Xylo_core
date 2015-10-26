<?php
namespace Xylo\Conf;

class Conf
{
    public static function loadApps()
    {
        return json_decode(file_get_contents(ROOT_PATH . '/Config/apps.json'));
    }
}
