<?php

namespace App\DataFixtures;

use App\Entity\Menus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class MenusFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $names = [
            'Formule du midi',
            'Menu Duo',
            'Menu Gourmands',
        ];

        $prices = [
            15,
            35,
            50,
        ];

        $faker = Faker\Factory::create('fr_FR');

        for ($i=1; $i <= 3 ; $i++) {
            $menu = new Menus();
            $menu->setTitle($names[$i-1]);
            $menu->setPrice($prices[$i-1])
                ->addDish($this->getReference('dish_' . $faker->numberBetween(1, 40)));
            $this->addReference('menu_' . $i, $menu);

                $manager->persist($menu);
        }
        
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            DishesFixtures::class
        ];
    }
}
