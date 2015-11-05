<?php
namespace Xylo\Conf;

class Conf
{
    const PATH_CONFIG = 'Config/config.ini';

    public static function loadApps()
    {
        return json_decode(file_get_contents(ROOT_PATH . '/Config/apps.json'), true);
    }

    public static function getConf($index = null)
    {
        $settings = parse_ini_file(ROOT_PATH . self::PATH_CONFIG, true);
        if ($index === null) {
            return $settings;
        }

        return $settings[$index];
    }
}
