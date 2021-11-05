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
    public function getPassword();
    public function checkPasswords(String $password1, 
                                   String $password2);
    public function savePassword(String $password);
    public function checkPasswordStrength(String $password);
}