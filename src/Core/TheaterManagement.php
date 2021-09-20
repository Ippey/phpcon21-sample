<?php

namespace App\Core;

use App\Entity\Theater;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TheaterManagement
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private TheaterManagementDataServiceInterface $dataService
    ) {
    }

    public function getActivatedUsers(Theater $theater): array
    {
        return $this->dataService->findActivatedUsers($theater);
    }

    public function createUser(Theater $theater, $name, $email, $password): User
    {
        $user = new User();
        $user
            ->setName($name)
            ->setEmail($email)
            ->setPassword($this->passwordHasher->hashPassword($user, $password))
            ->setRoles(['ROLE_USER'])
            ->setIsActivated(true)
            ;
        $theater->addUser($user);

        return $user;
    }
}
