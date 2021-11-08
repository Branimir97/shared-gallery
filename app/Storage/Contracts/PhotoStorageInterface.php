<?php

namespace Storage\Contracts;
use Models\Photo;

interface PhotoStorageInterface
{
    public function save(Photo $photo);
    public function findAll();
    public function delete(int $id);
    public function findById(int $id);
    public function count();
    public function findByUserId(int $id);
}