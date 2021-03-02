<?php
// ijungia klaidu rodyma
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once '../app/configuration/configuration.php';

use app\controller\MainController;

$controller = new MainController();

$controller->home();
