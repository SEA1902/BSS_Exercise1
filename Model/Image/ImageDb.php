<?php

namespace Model\Image;

class ImageDb
{
    protected $connect;

    public function  __construct($connect)
    {
        $this->connect = $connect;
    }

    public function addImage($image){
        $url = $image->getUrl();
        $person_id = $image->getPersonId();

        $sql = "INSERT INTO image(url, person_id) VALUES ('$url', '$person_id')";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
    }

    public function getImage($person_id)
    {
        $sql = "SELECT * FROM image WHERE person_id = '$person_id'";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function updateImage($url,$person_id)
    {
        $sql = "UPDATE image SET url = '$url' WHERE person_id = '$person_id'";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
    }

}