<?php

declare(strict_types=1);

namespace InITWorld\CanNotWriteTestToMethodPartOne;

use Money\Money;

class Before
{
    public function __construct(
        private readonly PartyIdentifier $identifier
    ) {
    }

    public function calculateNewPrice(Money $currentPrice, \DateTime $date): Money
    {
        if ($date->format('N') === '5') {
            $currentPrice = $currentPrice->add(new Money(200, $currentPrice->getCurrency()));
        }

        $repository = new CustomerDiscountRepository();
        $result = $repository->get($this->identifier);

        if ($result) {
            $discount = $currentPrice->multiply($result);
            $discount = $discount->divide(100);
            $newPrice = $currentPrice->subtract($discount);
        }

        return $newPrice ?? $currentPrice;
    }
}
