<?php
declare(strict_types=1);

ini_set("display_errors", "1");

require __DIR__  . "/bootstrap.php";

use Controller\DeviceController;

$deviceController = new DeviceController();

switch ($_SERVER['REQUEST_METHOD']) {
    case "GET":
        $deviceController->renderDashboard();
        break;

    case "POST":
        $deviceController->add();
        break;
    default:
        //404;
        break;
}