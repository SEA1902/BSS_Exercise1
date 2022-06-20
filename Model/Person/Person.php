<?php

namespace Model\Person;

class Person
{
    protected $id;
    protected $password;
    protected $name;
    protected $email;
    protected $gender;

    public function __construct($name, $email, $gender, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->gender = $gender;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }
    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

}