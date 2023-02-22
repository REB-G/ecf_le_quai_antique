<?php

namespace App\DataFixtures;

use App\Entity\Tables;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class TablesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i < 41; $i++) {
            $table = new Tables();
            $table->setTableNumber($faker->unique()->numberBetween(1, 40))
                ->setNumberOfPlaces($faker->numberBetween(2, 6))
                ->setIsAvailable($faker->boolean);
                
                $manager->persist($table);
        }
        $manager->flush();
    }
}
