<?php

namespace  Model\Person;

class PersonDb
{
    protected $connect;

    public function  __construct($connect)
    {
        $this->connect = $connect;
    }

    public function getPerson($id){
        $sql = "SELECT * FROM person WHERE id='$id' ";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function checkPerson($email, $password)
    {
        $sql = "SELECT * FROM person WHERE email='".$email."' AND password='".$password."'";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function addPerson($person)
    {
        try {
            $sql = "INSERT INTO person(name, email, gender, password) VALUE (?,?,?,?)";
            $stmt = $this->connect->prepare($sql);
            $newPerson = [
                $person->getName(),
                $person->getEmail(),
                $person->getGender(),
                $person->getPassword(),
            ];


            if (!$stmt->execute($newPerson)) {
                dd($newPerson, $this->connect, get_class_methods($stmt), $stmt->errorInfo());
                throw new \PDOException("Failed");
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function updatePerson($person, $id)
    {
        $name = $person->getName();
        $email = $person->getEmail();
        $gender = $person->getGender();
        $password = $person->getPassword();
        $sql = "UPDATE person SET name = '$name', email = '$email', gender = '$gender', password = '$password' WHERE id = '$id'";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
    }

    public function getAllPerson()
    {
        $sql = 'Select * from person';
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $this->createPersonFromDb($result);
    }

    public function createPersonFromDb($result)
    {
        $persons = [];
        foreach ($result as $key => $item) {
            $person = new Person($item["name"], $item["email"], $item["gender"], $item["password"]);
            array_push($persons, $person);
        }

        return $persons;
    }
}