<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class UsersFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $admin = new Users();
        $admin->setName('Nuttle')
            ->setFirstname('Ursule')
            ->setEmail('rest.quai.antique@gmail.com')
            ->setPassword($this->passwordHasher->hashPassword($admin, 'RestQuai.1'))
            ->setRoles(['ROLE_ADMIN'])
            ->setDefaultNumberOfGuests(1);

        $manager->persist($admin);

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i < 10; $i++) {
            $user = new Users();
            $user->setName($faker->lastName())
                ->setFirstname($faker->firstName())
                ->setEmail($faker->email())
                ->setPassword($this->passwordHasher->hashPassword($user, 'Restaurant.MotDePasse.1'))
                ->setDefaultNumberOfGuests($faker->numberBetween(1, 6));
            
                $manager->persist($user);
        }
        $manager->flush();
    }
}
