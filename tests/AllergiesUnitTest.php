<?php

namespace App\Tests;

use App\Entity\Allergies;
use PHPUnit\Framework\TestCase;

class AllergiesUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $allergy = new Allergies();

        $allergy->setName('name');

        $this->assertTrue($allergy->getName() === 'name');
    }

    public function testIsFalse(): void
    {
        $allergy = new Allergies();

        $allergy->setName('name');

        $this->assertFalse($allergy->getName() === 'false');
    }

    public function testIsEmpty(): void
    {
        $allergy = new Allergies();

        $this->assertEmpty($allergy->getName());
    }
}
