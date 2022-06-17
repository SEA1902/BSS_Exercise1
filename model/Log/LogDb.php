<?php

namespace  Model\Log;

class LogDb
{
    protected $connect;

    public function  __construct($connect)
    {
        $this->connect = $connect;
    }

    public function getAllLog()
    {
        $sql = 'select log.device_id, device.name_device, log.action, log.date 
                from log, device
                where log.device_id = device.id';
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $this->createLogFromDb($result);
    }

    public function createLogFromDb($result)
    {
        $logs = [];
        foreach ($result as $key => $item) {
            array_push($logs, $item);
        }
        return $logs;
    }
}