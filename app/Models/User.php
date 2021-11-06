<?php

namespace Models;

class User
{
    private $id;
    private $username;
    private $email;
    private $address;
    private $password;
    private $repeatedPassword;
    private $createdAt;

    public function getId()
    {
        return $this->id;
    }
    
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;    
    }

    public function getRepeatedPassword() 
    {
        return $this->repeatPassword;
    }

    public function setRepeatedPassword(string $password) 
    {
        $this->repeatPassword = $password;
    }

    public function getCreatedAt() 
    {
        $this->createdAt = new \DateTime('now');
        return $this->createdAt;
    }
}