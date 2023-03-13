<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $names = [
            'Entrée',
            'Plat',
            'Burger',
            'Végétarien',
            'Dessert',
        ];
        for ($i=1; $i <= 5 ; $i++) {
            $category = new Categories();

            $category->setName($names[$i-1]);
            $this->addReference('category_' . $i, $category);

                $manager->persist($category);
        }
        $manager->flush();
    }
}
