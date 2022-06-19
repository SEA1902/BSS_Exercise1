<?php

namespace Model\Log;

class Log
{
    protected $id;
    protected $action;
    protected $date;

    public function __construct($id, $action, $date)
    {
        $this->id = $id;
        $this->action = $action;
        $this->date = $date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
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