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
            $stmt = $this->personDb->checkPerson($email, $password);
            return $stmt;
        }
    }
    public function add(){

        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
            if (empty($_POST["name"])) {
                $errors[]  = "Name is required";
            } else{
                $name = $this->test_input($_POST["name"]);
            }

            if (empty($_POST["email"])) {
                $errors[]  = "Email is required";
            } else{
                $email= $this->test_input($_POST["name"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Invalid email format";
                }
            }

            if (empty($_POST["password"])) {
                $errors[]  = "Password is required";
            } else{
                $password = $this->test_input($_POST["password"]);
                if (strlen($_POST["password"]) < '8') {
                    $errors[]  = "Your Password Must Contain At Least 8 Characters!";
                }
            }


            if (isset($errors)) {
                throw new InputException($errors);
            }

//            $name = $_POST["name"];
//            $email = $_POST["email"];
            $gender = $this->test_input($_POST["gender"]);
//            $password = $_POST["password"];
            $person = new Person($name, $email, $gender, $password);
            $this->personDb->addPerson($person);
        }

    }
    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
class InputException extends \Exception
{
    private $data;

    public function __construct($data, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}