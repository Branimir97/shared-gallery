<?php

namespace Storage\Contracts;
use Models\User;

interface UserStorageInterface
{
    public function save(User $user);
    public function auth(User $user);
    public function findUserFromSession();
    public function changePassword(string $currentPassword, 
                                   string $newPassword, 
                                   string $newPasswordRepeat);
    public function getPassword();
    public function checkPasswords(string $password1, 
                                   string $password2);
    public function savePassword(string $password);
    public function checkPasswordStrength(string $password);
    public function deleteAccount();
    public function findByEmail(string $email);
}