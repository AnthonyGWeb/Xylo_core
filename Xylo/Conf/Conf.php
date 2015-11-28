<?php
namespace Xylo\Conf;

class Conf
{
    const PATH_CONFIG = 'Config/config.ini';

    public static function getConf($index = null)
    {
        // TODO memcache + Refactor and optimize code
        $settings = parse_ini_file(ROOT_PATH . self::PATH_CONFIG, true);
        if ($index === null) {
            return $settings;
        }

        $index = explode('.', $index);
        foreach ($index as $level) {
            $settings = isset($settings[$level]) ? $settings[$level] : false;
        }

        return $settings;
    }
}
