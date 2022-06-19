<?php

namespace Controller;

use model\Database\DBConnect;
use Model\Log\LogDb;

class LogController
{
    protected $logDb;

    public function __construct()
    {
        $db = new DBConnect();
        $this->logDb = new LogDb($db->connect());
    }

    public function getAllLog()
    {
        return $this->logDb->getAllLog();
    }
}
