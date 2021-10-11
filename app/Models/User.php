<?php

namespace Models;

class User
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $createdAt;

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
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

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;    
    }

    public function getCreatedAt() {
        $this->createdAt = new \DateTime('now');
        return $this->createdAt;
    }
}