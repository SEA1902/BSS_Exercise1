<?php

namespace Model\Device;

class Device
{
    protected $id;
    protected $name_device;
    protected $ip;
    protected $mac;
    protected $create_date;
    protected $power_consumption;

    public function __construct($name_device, $ip, $mac, $create_date, $power_consumption)
    {
        $this->name_device = $name_device;
        $this->ip = $ip;
        $this->mac = $mac;
        $this->create_date = $create_date;
        $this->power_consumption = $power_consumption;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName_device()
    {
        return $this->name_device;
    }

    public function setName_device($name_device): void
    {
        $this->name_device = $name_device;
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
    public function getCreate_date()
    {
        return $this->create_date;
    }

    public function setCreate_date($create_date): void
    {
        $this->create_date = $create_date;
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