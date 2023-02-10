<?php

namespace App\Tests;

use App\Entity\Users;
use PHPUnit\Framework\TestCase;

class UsersUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $user = new Users();

        $user->setEmail('true@test.com')
            ->setPassword('password')
            ->setName('prenom')
            ->setFirstname('nom')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());

        $this->assertTrue($user->getEmail() === 'true@test.com');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getRoles() === ['ROLE_USER']);
        $this->assertTrue($user->getName() === 'prenom');
        $this->assertTrue($user->getFirstname() === 'nom');
        $this->assertTrue($user->getCreatedAt() instanceof \DateTimeImmutable);
        $this->assertTrue($user->getUpdatedAt() instanceof \DateTimeImmutable);
    }

    public function testIsFalse(): void
    {
        $user = new Users();

        $user->setEmail('true@test.com')
            ->setPassword('password')
            ->setName('prenom')
            ->setFirstname('nom')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());

        $this->assertFalse($user->getEmail() === 'false@test.com');
        $this->assertFalse($user->getPassword() === 'false');
        $this->assertFalse($user->getRoles() === ['false']);
        $this->assertFalse($user->getName() === 'false');
        $this->assertFalse($user->getFirstname() === 'false');
        $this->assertFalse($user->getCreatedAt() instanceof \DateTime);
        $this->assertFalse($user->getUpdatedAt() instanceof \DateTime);
    }

    public function testIsEmpty(): void
    {
        $user = new Users();

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getName());
        $this->assertEmpty($user->getFirstname());
    }
}