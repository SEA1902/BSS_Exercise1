<?php

namespace Controller;

use Model\Image\ImageDb;
use Model\Image\Image;
use model\Database\DBConnect;
class ImageController
{
    protected $imageDb;
    public function __construct()
    {
        $db = new DBConnect();
        $this->imageDb = new ImageDb($db->connect());
    }

    public function addImage($id){
        $url = $_POST["url"];
        $image = new Image($url, $id);
        $this->imageDb->addImage($image);
    }

    public function getImage($person_id)
    {
        return $this->imageDb->getImage($person_id);
    }

    public function updateImage($person_id)
    {
        $url = $_POST["url"];
        return $this->imageDb->updateImage($url, $person_id);
    }


}