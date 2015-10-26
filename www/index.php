<?php
define("ROOT_PATH", __DIR__ . '/../');

require_once ROOT_PATH . 'Xylo/Autoloader/Autoloader.php';

use Xylo\Autoloader\Autoloader;

Autoloader::register();

$application = new \Xylo\Application\Application();
$application->run();
