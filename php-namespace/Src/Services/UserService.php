<?php

namespace Src\Services;

use Src\Models\User;

class UserService
{
    public function createUser(string $name, string $email): User
    {
        return new User($name, $email);
    }
    public function displayUser(User $user): string
    {
        return "Nama: " . $user->getName()
            . " | Email: " . $user->getEmail();
    }
}
