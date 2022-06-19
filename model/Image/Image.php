<?php

namespace Model\Image;

class Image
{
    protected $id;
    protected $url;
    protected $person_id;

    public function __construct($url, $person_id)
    {
        $this->url = $url;
        $this->person_id = $person_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url): void
    {
        $this->url = $url;
    }

    public function getPersonId()
    {
        return $this->person_id;
    }

    public function setPersonId($person_id): void
    {
        $this->person_id = $person_id;
    }

}