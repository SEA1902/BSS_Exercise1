<?php

namespace Controller;

use model\Database\DBConnect;
use Model\Device\Device;
use model\Device\DeviceDb;

class DeviceController
{
    protected $deviceDb;

    public function __construct()
    {
        $db = new DBConnect();
        $this->deviceDb = new DeviceDb($db->connect());
    }

    public function getAllDevice()
    {
        return $this->deviceDb->getAllDevice();
    }

    public function add(){
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
            $device = $_POST["device"];
            $ip = $_POST["ip"];
            $mac = $_POST["mac"];
            $date = date("y-m-d");
            $power_consumption = $_POST["power_consumption"];
            $device = new Device($device, $ip, $mac,$date, $power_consumption);
            $this->deviceDb->addDevice($device);
        }

    }

}