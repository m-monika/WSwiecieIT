<?php

declare(strict_types=1);

namespace InITWorld\Tests\CanNotWriteTestToMethodPartOne;

use InITWorld\CanNotWriteTestToMethodPartOne\After;
use InITWorld\CanNotWriteTestToMethodPartOne\CustomerDiscountRepository;
use InITWorld\CanNotWriteTestToMethodPartOne\PartyIdentifier;
use Money\Money;
use PHPUnit\Framework\TestCase;

class AfterTest extends TestCase
{
    private CustomerDiscountRepository $repository;
    private After $after;

    public function setUp(): void
    {
        $this->repository = $this->createMock(CustomerDiscountRepository::class);
        $this->after = new class ($this->repository) extends After
        {
            private CustomerDiscountRepository $repository;

            public function __construct(CustomerDiscountRepository $repository)
            {
                parent::__construct(new PartyIdentifier('UUID'));
                $this->repository = $repository;
            }

            protected function getRepository(): CustomerDiscountRepository
            {
                return $this->repository;
            }
        };
    }

    public function testCalculatePriceWhenNoDiscount(): void
    {
        $this->repository
            ->expects($this->once())
            ->method('get')
            ->willReturn(null);
        $price = Money::PLN(1000);
        $monday = new \DateTime('2022-07-18');
        $this->assertEquals($price, $this->after->calculateNewPrice($price, $monday));
    }

    public function testCalculatePriceWhenTenPercentageDiscount(): void
    {
        $this->repository
            ->expects($this->once())
            ->method('get')
            ->willReturn(10);

        $originalPrice = Money::PLN(1000);
        $newPrice = Money::PLN(900);
        $monday = new \DateTime('2022-07-18');
        $this->assertEquals($newPrice, $this->after->calculateNewPrice($originalPrice, $monday));
    }

    public function testCalculatePriceOnFridayWhenNoDiscount(): void
    {
        $this->repository
            ->expects($this->once())
            ->method('get')
            ->willReturn(null);

        $originalPrice = Money::PLN(1000);
        $newPrice = Money::PLN(1200);
        $friday = new \DateTime('2022-07-22');
        $this->assertEquals($newPrice, $this->after->calculateNewPrice($originalPrice, $friday));
    }

    public function testCalculatePriceOnFridayWithDiscount(): void
    {
        $this->repository
            ->expects($this->once())
            ->method('get')
            ->willReturn(10);

        $originalPrice = Money::PLN(1000);
        $newPrice = Money::PLN(1080);
        $friday = new \DateTime('2022-07-22');
        $this->assertEquals($newPrice, $this->after->calculateNewPrice($originalPrice, $friday));
    }
}
