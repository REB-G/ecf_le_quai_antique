<?php

namespace App\DataFixtures;

use App\Entity\Allergies;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AllergiesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $names = [
            'Aucune',
            'Gluten',
            'Moutarde',
            'Crustacés',
            'Oeufs',
            'Poissons',
            'Arachide',
            'Lactose',
            'Graines de sésame',
            'Soja',
            'Fruits à coque',
        ];
        for ($i=1; $i <=11; $i++) {
            $allergy = new Allergies();

            $allergy->setName($names[$i-1]);

            $manager->persist($allergy);
        }
        $manager->flush();
    }
}
