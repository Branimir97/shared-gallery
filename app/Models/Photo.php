<?php

namespace Models;
use Models\User;

class Photo
{
    private $id;
    private $user;
    private $path;
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

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath(string $path)
    {
        $this->path = $path;
    }

    public function getCreatedAt() 
    {
        $this->createdAt = new \DateTime('now');
        return $this->createdAt;
    }
}