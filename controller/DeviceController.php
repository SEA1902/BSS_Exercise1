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

    /**
     * @return bool|void
     * @throws InputException
     */
    public function add()
    {
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
            if (empty($_POST["name_device"])) {
                $errors[]  = "Name device is required";
            } else{
                $name_device = $this->test_input($_POST["name_device"]);
            }

            if (empty($_POST["ip"])) {
                $errors[] = "IP is required";
            }else{
                $ip = $this->test_input($_POST["ip"]);
            }

            if (isset($errors)) {
                throw new InputException($errors);
            }
            $mac = $this->test_input($_POST["mac"]);
            $create_date = date("y-m-d");
            $power_consumption = $this->test_input($_POST["power_consumption"]);
            $device = new Device($name_device, $ip, $mac, $create_date, $power_consumption);
            $this->deviceDb->addDevice($device);
            return true;
        }
    }

    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}

class InputException extends \Exception
{
    private $data;

    public function __construct($data, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}