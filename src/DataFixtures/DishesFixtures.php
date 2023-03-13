<?php

namespace App\DataFixtures;

use App\Entity\Dishes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class DishesFixtures extends Fixture implements DependentFixtureInterface
{
    
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i < 40; $i++) {
            $dish = new Dishes();
            $dish->setName($faker->word)
                ->setDescription($faker->text(200))
                ->setPrice($faker->numberBetween(7, 28))
                ->setImageName('default.jpg')
                ->setCategory($this->getReference('category_' . $faker->numberBetween(1, 3)));
            $this->addReference('dish_' . $i, $dish);

                $manager->persist($dish);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoriesFixtures::class
        ];
    }
}
