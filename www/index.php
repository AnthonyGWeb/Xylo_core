<?php
define("ROOT_PATH", __DIR__ . '/../');
define("APP_PATH", __DIR__ . '/../App/');

require_once ROOT_PATH . 'vendor/autoload.php';

$application = new \Xylo\Application\Application();
$application->init();
$application->executePostCallPlugins();
$application->run();
$application->executePostCallPlugins();
die;
