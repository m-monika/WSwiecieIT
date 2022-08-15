<?php

declare(strict_types=1);

namespace InITWorld\CanNotWriteTestToMethodPartTwo;

use Money\Money;

class Before
{
    public function __construct(
        private readonly ?int $customerDiscount = null
    ) {
    }

    // a lot of different method, a lot of legacy

    private function calculateNewPrice(Money $currentPrice, \DateTime $date): Money
    {
        if ($date->format('N') === '5') {
            $currentPrice = $currentPrice->add(new Money(200, $currentPrice->getCurrency()));
        }

        if ($this->customerDiscount) {
            $discount = $currentPrice->multiply($this->customerDiscount);
            $discount = $discount->divide(100);
            $newPrice = $currentPrice->subtract($discount);
        }

        return $newPrice ?? $currentPrice;
    }
}
