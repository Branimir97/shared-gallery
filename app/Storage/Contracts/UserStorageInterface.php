<?php

namespace Storage\Contracts;
use Models\User;

interface UserStorageInterface
{
    public function save(User $user);
    public function auth(User $user);
    public function findUserFromSession();
    public function changePassword(String $currentPassword, 
                                   String $newPassword, 
                                   String $newPasswordRepeat);
}