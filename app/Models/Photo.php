<?php

namespace Models;
use Models\User;

class Photo
{
    private $id;
    private $user;
    private $fileName;
    private $createdAt;

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(int $user)
    {
        $this->user = $user;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function getCreatedAt() 
    {
        $this->createdAt = new \DateTime('now');
        return $this->createdAt;
    }
}