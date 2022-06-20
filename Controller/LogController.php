<?php

namespace Controller;

use Model\Database\DBConnect;
use Model\Log\LogDb;

class LogController
{
    protected $logDb;

    public function __construct()
    {
        $db = new DBConnect();
        $this->logDb = new LogDb($db->connect());
    }

    public function renderLogs()
    {
        include_once ROOT_PATH . '/View/Logs.phtml';
    }

    public function getAllLog()
    {
        return $this->logDb->getAllLog();
    }


}
