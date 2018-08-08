<?php
use Yaf\Application;
define('APPLICATION_PATH', dirname(__FILE__));

require_once APPLICATION_PATH . "/vendor/autoload.php";

$application = new Application( APPLICATION_PATH . "/conf/application.ini");

$application->bootstrap()->run();
?>
