<?php

namespace Controller;

use Model\Database\DBConnect;
use Model\Device\Device;
use Model\Device\DeviceDb;
use Exceptions\InputException;

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

    public function renderDashboard()
    {
        include_once ROOT_PATH . '/View/Dashboard.phtml';
    }

    public function add()
    {
        try {
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
            header('Location: Dashboard.php');
        } catch (InputException $e) {
            $errs = $e->getData();
            session_start();
            $_SESSION['err'] = $errs;
            header('Location: Dashboard.php');
        }
    }

    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
