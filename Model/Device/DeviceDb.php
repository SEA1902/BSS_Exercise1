<?php

namespace Model\Device;

class DeviceDb
{
    protected $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function addDevice($device)
    {
        try {
            $sql = "INSERT INTO device(name_device, ip, mac, create_date, power_consumption) VALUE (?,?,?,?,?)";
            $stmt = $this->connect->prepare($sql);
            $newDevice = [
                $device->getName_device(),
                $device->getIp(),
                $device->getMac(),
                $device->getCreate_date(),
                $device->getPower_consumption(),
            ];

            if (!$stmt->execute($newDevice)) {
                throw new \PDOException("Failed");
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function getDeviceByMac($mac)
    {
        $sql = "Select * from device WHERE mac = '$mac' " ;
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();

        $count = $stmt->rowCount();

        return $count;
    }

    public function getAllDevice()
    {
        $sql = 'Select * from device';
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    public function createDeviceFromDb($result)
    {
        $devices = [];
        foreach ($result as $key => $item) {
            $device = new Device($item["name_device"], $item["ip"], $item["mac"],$item["create_date"], $item["power_consumption"]);
            array_push($devices, $device);
        }

        return $devices;
    }

}