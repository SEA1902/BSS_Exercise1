<?php

namespace Model\Log;

class Log
{
    protected $device_id;
    protected $action;
    protected $date;

    public function __construct($device_id, $action, $date)
    {
        $this->device_id = $device_id;
        $this->action = $action;
        $this->date = $date;
    }

    public function getDeviceId()
    {
        return $this->device_id;
    }

    public function setDeviceId($device_id): void
    {
        $this->device_id = $device_id;
    }

    public function getAction()
    {
        return $this->action;
    }
    public function setAction($action): void
    {
        $this->action = $action;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

}