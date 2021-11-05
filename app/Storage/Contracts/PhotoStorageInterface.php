<?php

namespace Storage\Contracts;
use Models\Photo;

interface PhotoStorageInterface
{
    public function save(Photo $photo);
}