<?php

namespace App\Core;

use App\Entity\Theater;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TheaterManagement
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function createUser(Theater $theater, $name, $email, $password): User
    {
        $user = new User();
        $user
            ->setName($name)
            ->setEmail($email)
            ->setPassword($this->passwordHasher->hashPassword($user, $password))
            ;
        $theater->addUser($user);

        return $user;
    }
}
