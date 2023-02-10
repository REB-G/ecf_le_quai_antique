<?php

namespace App\Tests;

use App\Entity\Menus;
use PHPUnit\Framework\TestCase;

class MenusUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $menu = new Menus();

        $menu->setTitle('title')
            ->setPrice(24.50);

        $this->assertTrue($menu->getTitle() === 'title');
        $this->assertTrue($menu->getPrice() === 24.50);
    }

    public function testIsFalse(): void
    {
        $menu = new Menus();

        $menu->setTitle('title')
            ->setPrice(24.50);

        $this->assertFalse($menu->getTitle() === 'false');
        $this->assertFalse($menu->getTitle() === 'false');
    }

    public function testIsEmpty(): void
    {
        $menu = new Menus();

        $this->assertEmpty($menu->getTitle());
        $this->assertEmpty($menu->getPrice());
    }
}