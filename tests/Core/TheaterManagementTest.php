<?php

namespace App\Tests\Core;

use App\Core\TheaterManagement;
use App\Core\TheaterManagementDataServiceInterface;
use App\Entity\Theater;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;

class TheaterManagementTest extends TestCase
{
    /**
     * @test
     */
    public function getActivatedUsers()
    {
        $users = [
            new User(),
            new User(),
        ];
        $passwordHasher = $this->createMock(UserPasswordHasher::class);
        $dataService = $this->createMock(TheaterManagementDataServiceInterface::class);
        $dataService
            ->method('findActivatedUsers')
            ->willReturn($users)
        ;

        $management = new TheaterManagement($passwordHasher, $dataService);
        $result = $management->getActivatedUsers(new Theater());
        $this->assertEquals($users, $result);
    }

    /**
     * @test
     */
    public function createUser(): void
    {
        $passwordHasher = $this->createMock(UserPasswordHasher::class);
        $dataService = $this->createMock(TheaterManagementDataServiceInterface::class);
        $passwordHasher->method('hashPassword')
            ->willReturnCallback(function ($user, $password) {
                return $password.'_hashed';
            })
            ;

        $theater = new Theater();
        $name = 'お名前';
        $email = 'test@phpcon.php.gr.jp';
        $password = 'strong_password';

        $management = new TheaterManagement($passwordHasher, $dataService);
        $user = $management->createUser($theater, $name, $email, $password);

        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($password.'_hashed', $user->getPassword());
        $this->assertSame($theater, $user->getTheater());
        $this->assertEquals(['ROLE_USER'], $user->getRoles());
        $this->assertContains($user, $theater->getUsers());
    }
}
