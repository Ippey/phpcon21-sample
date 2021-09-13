<?php

namespace App\Tests\Core;

use App\Core\TheaterManagement;
use App\Entity\Theater;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;

class TheaterManagementTest extends TestCase
{
    /**
     * @test
     */
    public function createUser(): void
    {
        $passwordHasher = $this->createMock(UserPasswordHasher::class);
        $passwordHasher->method('hashPassword')
            ->willReturnCallback(function ($user, $password) {
                return $password.'_hashed';
            })
            ;

        $theater = new Theater();
        $name = 'お名前';
        $email = 'test@phpcon.php.gr.jp';
        $password = 'strong_password';

        $management = new TheaterManagement($passwordHasher);
        $user = $management->createUser($theater, $name, $email, $password);

        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($password.'_hashed', $user->getPassword());
        $this->assertSame($theater, $user->getTheater());
        $this->assertContains($user, $theater->getUsers());
    }
}
