<?php

declare(strict_types=1);

namespace InITWorld\CodeSmells\PrimitiveObsession;

class BasketBefore
{
    private float $totalPrice = 0;

    // ...

    public function add(float $price): void
    {
        $this->totalPrice += $price;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    // ...
}
