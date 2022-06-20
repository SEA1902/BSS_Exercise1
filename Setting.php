<?php

declare(strict_types=1);

ini_set("display_errors", "1");

require __DIR__ . "/bootstrap.php";

use Controller\PersonController;

$personController = new PersonController();

switch ($_SERVER['REQUEST_METHOD']) {
    case "GET":
        $personController->renderSetting();
        break;

//    case "POST":
//        $deviceController->add();

    default:
        //404;
        break;
}