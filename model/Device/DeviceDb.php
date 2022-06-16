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
            $sql = "INSERT INTO device(device, ip, mac, date, power_consumption) VALUE (?,?,?,?,?)";
            $stmt = $this->connect->prepare($sql);
            $newDevice = [
                $device->getDevice(),
                $device->getIp(),
                $device->getMac(),
                $device->getDate(),
                $device->getPower_consumption(),
            ];

            if (!$stmt->execute($newDevice)) {
                throw new \PDOException("Failed");
            }
        } catch (\Exception $e) {
            dd($e);
        }
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
            $device = new Device($item["device"], $item["ip"], $item["mac"],$item["date"], $item["power_consumption"]);
            array_push($devices, $device);
        }

        return $devices;
    }

}