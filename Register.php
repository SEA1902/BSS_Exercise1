<?php
declare(strict_types=1);

require_once __DIR__ ."/bootstrap.php";

use Controller\PersonController;

$personController = new PersonController();

switch ($_SERVER['REQUEST_METHOD']) {
    case "GET":
        $personController->renderRegister();
        break;

    case "POST":
        $personController->add();
        break;
    default:
        //404;
        break;
}