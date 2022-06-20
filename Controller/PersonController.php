<?php

namespace Controller;

use Model\Database\DBConnect;
use Model\Person\Person;
use Model\Person\PersonDb;;
use Exceptions\InputException;

class PersonController
{
    protected $personDb;
    public function __construct()
    {
        $db = new DBConnect();
        $this->personDb = new PersonDb($db->connect());
    }
    public function renderLogin()
    {
        include_once ROOT_PATH . '/View/Login.phtml';
    }

    public function renderRegister()
    {
        include_once ROOT_PATH . '/View/Register.phtml';
    }

    public function renderSetting()
    {
        include_once ROOT_PATH . '/View/Setting.phtml';
    }

    public function getAllPerson()
    {
        return $this->personDb->getAllPerson();
    }

    public  function getPerson($id){
        return $this->personDb->getPerson($id);
    }

    public function check(){
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
            $email = $_POST["email"];
            $password = $_POST["password"];
            $stmt = $this->personDb->checkPerson($email, $password);
            $count = $stmt->rowCount();

            if($count > 0){
                session_start();
                $_SESSION['user'] = $stmt->fetchAll();
                header('Location: index.php');exit;
            }else{
                $err = "Email hoặc mật khẩu không chính xác";
                session_start();
                $_SESSION["err"]= $err;
                header('Location: Login.php');exit;
            }

        }
    }

    public function update(){
        $imageController = new ImageController();
        $id = $_POST["id"];
        if (isset($_POST["update"])){
            try{
                if (empty($_POST["name"])) {
                    $errors[]  = "Name is required";
                } else{
                    $name = $this->test_input($_POST["name"]);
                }

                if (empty($_POST["email"])) {
                    $errors[]  = "Email is required";
                } else{
                    $email= $this->test_input($_POST["email"]);
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
                $gender = $_POST["gender"];

                $person = new Person($name, $email, $gender, $password);
                $this->personDb->updatePerson($person, $id);
                session_start();
                $_SESSION['user'] = $this->getPerson($id);
                header('Location: Setting.php');
            } catch(\Controller\InputException  $e){
                $errs = $e->getData();
                $_SESSION['err'] = $errs;
                header('Location: Setting.php');
            }
        }elseif (isset($_POST["add_image"])){
            $imageController->addImage($id);
            header('Location: Setting.php');
        } elseif (isset($_POST["update_image"])){
            $imageController->updateImage($id);
            header('Location: Setting.php');
        }
    }

    public function add(){
        try{
            if (empty($_POST["name"])) {
                $errors[]  = "Name is required";
            } else{
                $name = $this->test_input($_POST["name"]);
            }

            if (empty($_POST["email"])) {
                $errors[]  = "Email is required";
            } else{
                $email= $this->test_input($_POST["email"]);
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

            $gender = $this->test_input($_POST["gender"]);
            $person = new Person($name, $email, $gender, $password);
            $this->personDb->addPerson($person);
            header('Location: Login.php');
        } catch(InputException  $e){
            $errs = $e->getData();
            session_start();
            $_SESSION['err'] = $errs;
            header('Location: Register.php');
        }

    }
    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
//class InputException extends \Exceptions
//{
//    private $data;
//
//    public function __construct($data, string $message = "", int $code = 0, ?Throwable $previous = null)
//    {
//        parent::__construct($message, $code, $previous);
//        $this->data = $data;
//    }
//
//    public function getData()
//    {
//        return $this->data;
//    }
//}