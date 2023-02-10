<?php

namespace App\Tests;

use App\Entity\Categories;
use PHPUnit\Framework\TestCase;

class CategoriesUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $category = new Categories();

        $category->setName('name');

        $this->assertTrue($category->getName() === 'name');
    }

    public function testIsFalse(): void
    {
        $category = new Categories();

        $category->setName('name');

        $this->assertFalse($category->getName() === 'false');
    }

    public function testIsEmpty(): void
    {
        $category = new Categories();

        $this->assertEmpty($category->getName());
    }
}