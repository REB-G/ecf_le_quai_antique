<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UsersFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 10; $i++) {
            $user = new Users();
            $user->setName($this->faker->lastName())
                ->setFirstname($this->faker->firstName())
                ->setEmail($this->faker->email())
                ->setPlainPassword('password')
                ->setDefaultNumberOfGuests($this->faker->numberBetween(1, 6));
            
                $manager->persist($user);
        }


        $manager->persist($user);

        $manager->flush();
    }
}
