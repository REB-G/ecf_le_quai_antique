<?php

namespace App\EntityListener;

use App\Entity\Users;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersListener
{

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function prePersist(Users $user): void
    {
        $this->encodePassword($user);
    }

    public function preUpdate(Users $user): void
    {
        $this->encodePassword($user);
    }

    public function encodePassword(Users $user): void
    {
        $user->setPassword(
            $this->hasher->hashPassword(
                $user,
                $user->getPlainPassword()
                )
            );
    }
}