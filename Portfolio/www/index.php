<?php
define("ROOT_PATH", __DIR__ . '/../../');

require_once ROOT_PATH . 'vendor/autoload.php';

$application = new \Xylo\Application\Application();
$application->init();
$application->run();
