<?php

declare(strict_types=1);

namespace InITWorld\Tests\CanNotWriteTestToMethodPartTwo;

use InITWorld\CanNotWriteTestToMethodPartTwo\After;
use Money\Money;
use PHPUnit\Framework\TestCase;

class AfterTest extends TestCase
{
    public function testCalculatePriceWhenNoDiscount(): void
    {
        $after = new class (null) extends After
        {
            public function calculateNewPrice(Money $currentPrice, \DateTime $date): Money
            {
                return parent::calculateNewPrice($currentPrice, $date);
            }
        };
        $price = Money::PLN(1000);
        $monday = new \DateTime('2022-07-18');
        $this->assertEquals($price, $after->calculateNewPrice($price, $monday));
    }

    public function testCalculatePriceWhenTenPercentageDiscount(): void
    {
        $after = new class (10) extends After
        {
            public function calculateNewPrice(Money $currentPrice, \DateTime $date): Money
            {
                return parent::calculateNewPrice($currentPrice, $date);
            }
        };

        $originalPrice = Money::PLN(1000);
        $newPrice = Money::PLN(900);
        $monday = new \DateTime('2022-07-18');
        $this->assertEquals($newPrice, $after->calculateNewPrice($originalPrice, $monday));
    }

    public function testCalculatePriceOnFridayWhenNoDiscount(): void
    {
        $after = new class (null) extends After
        {
            public function calculateNewPrice(Money $currentPrice, \DateTime $date): Money
            {
                return parent::calculateNewPrice($currentPrice, $date);
            }
        };

        $originalPrice = Money::PLN(1000);
        $newPrice = Money::PLN(1200);
        $friday = new \DateTime('2022-07-22');
        $this->assertEquals($newPrice, $after->calculateNewPrice($originalPrice, $friday));
    }

    public function testCalculatePriceOnFridayWithDiscount(): void
    {
        $after = new class (10) extends After
        {
            public function calculateNewPrice(Money $currentPrice, \DateTime $date): Money
            {
                return parent::calculateNewPrice($currentPrice, $date);
            }
        };

        $originalPrice = Money::PLN(1000);
        $newPrice = Money::PLN(1080);
        $friday = new \DateTime('2022-07-22');
        $this->assertEquals($newPrice, $after->calculateNewPrice($originalPrice, $friday));
    }
}
