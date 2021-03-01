<?php
require_once '../vendor/autoload.php';

use app\controller\MainController;

$controller = new MainController();

$controller->home();
