<?php

namespace App\Tests;

use App\Entity\Dishes;
use PHPUnit\Framework\TestCase;

class DishesUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $dish = new Dishes();

        $dish->setName('name')
            ->setDescription('description')
            ->setPrice(24.50);

        $this->assertTrue($dish->getName() === 'name');
        $this->assertTrue($dish->getDescription() === 'description');
        $this->assertTrue($dish->getPrice() === 24.50);
    }

    public function testIsFalse(): void
    {
        $dish = new Dishes();

        $dish->setName('name')
            ->setDescription('description')
            ->setPrice(24.50);

        $this->assertFalse($dish->getname() === 'false');
        $this->assertFalse($dish->getDescription() === 'false');
        $this->assertFalse($dish->getPrice() === 'false');
    }

    public function testIsEmpty(): void
    {
        $dish = new Dishes();

        $this->assertEmpty($dish->getname());
        $this->assertEmpty($dish->getDescription());
        $this->assertEmpty($dish->getPrice());
    }
}
