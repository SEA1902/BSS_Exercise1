<?php
declare(strict_types=1);

require_once __DIR__ ."/bootstrap.php";

use Controller\PersonController;
use Controller\DeviceController;

$personController = new PersonController();
$deviceController = new DeviceController();

switch ($_SERVER['REQUEST_METHOD']) {
    case "GET":
        $personController->renderLogin();
        break;

    case "POST":
        $personController->check();
        break;
    default:
        //404;
        break;
}