<?php
declare(strict_types=1);

ini_set("display_errors", "1");

require __DIR__  . "/bootstrap.php";

use Controller\LogController;

$logController = new LogController();

switch ($_SERVER['REQUEST_METHOD']) {
    case "GET":
        $logController->renderLogs();
        break;

//    case "POST":
//        $deviceController->add();

    default:
        //404;
        break;
}