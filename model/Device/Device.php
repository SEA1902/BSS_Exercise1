<?php

namespace Model\Device;

class Device
{
    protected $id;
    protected $device;
    protected $ip;
    protected $mac;
    protected $date;
    protected $power_consumption;

    public function __construct($device, $ip, $mac, $date, $power_consumption)
    {
        $this->device = $device;
        $this->ip = $ip;
        $this->mac = $mac;
        $this->date = $date;
        $this->power_consumption = $power_consumption;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getDevice()
    {
        return $this->device;
    }

    public function setDevice($device): void
    {
        $this->device = $device;
    }
    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip): void
    {
        $this->ip = $ip;
    }
    public function getMac()
    {
        return $this->mac;
    }

    public function setMac($mac): void
    {
        $this->mac = $mac;
    }
    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getPower_consumption()
    {
        return $this->power_consumption;
    }

    public function setPower_consumption($power_consumption): void
    {
        $this->power_consumption = $power_consumption;
    }

}