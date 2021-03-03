<?php
// enable errors display
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once '../app/configuration/configuration.php';


use app\controller\MainController;

session_start();

$controller = new MainController();

/////////////////////////////////////////////
// call different method based on browser URL
$path = $_SERVER['REQUEST_URI'] ?? '/';

if ($path == '/2021_03_01_PRAKTINIO_DARBO_EGZAMINO_ATSISKAITYMAS_SPORTO_KLUBAS/login') {
	$controller->login();
} elseif ($path == '/2021_03_01_PRAKTINIO_DARBO_EGZAMINO_ATSISKAITYMAS_SPORTO_KLUBAS/register') {
	$controller->register();
} elseif ($path == '/2021_03_01_PRAKTINIO_DARBO_EGZAMINO_ATSISKAITYMAS_SPORTO_KLUBAS/feedback') {
	$controller->feedback();
} elseif ($path == '/2021_03_01_PRAKTINIO_DARBO_EGZAMINO_ATSISKAITYMAS_SPORTO_KLUBAS/logout') {
	$controller->logout();
} else {
	$controller->home();
}	