<?php

namespace Controller;

use model\Database\DBConnect;
use Model\Person\Person;
use model\Person\PersonDb;

class PersonController
{
    protected $personDb;

    public function __construct()
    {
        $db = new DBConnect();
        $this->personDb = new PersonDb($db->connect());
    }

    public function getAllPerson()
    {
        return $this->personDb->getAllPerson();
    }

    public function check(){
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
            $email = $_POST["email"];
            $password = $_POST["password"];
            $this->personDb->checkPerson($email, $password);
        }
    }
    public function add(){

//        try {
//            $name = $_POST["name"];
//            $email = $_POST["email"];
//            $gender = $_POST["gender"];
//            $password = $_POST["password"];
//            $person = new Person($name, $email, $gender, $password);
//            $this->personDb->addPerson($person);
//
//            return true;
//        } catch (\Exception $e) {
//            dd($e);
//            return false;
//        }
        // dd(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST", $_SERVER['REQUEST_METHOD']);
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
            $name = $_POST["name"];
            $email = $_POST["email"];
            $gender = $_POST["gender"];
            $password = $_POST["password"];
            $person = new Person($name, $email, $gender, $password);
            $this->personDb->addPerson($person);
        }

    }

}