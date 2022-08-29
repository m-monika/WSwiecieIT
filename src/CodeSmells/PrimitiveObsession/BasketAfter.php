<?php

declare(strict_types=1);

namespace InITWorld\CodeSmells\PrimitiveObsession;

use Money\Money;

class BasketAfter
{
    private Money|null $totalPrice;

    // ...

    public function add(Money $money): void
    {
        if ($this->totalPrice === null) {
            $this->totalPrice = $money;

            return;
        }

        $this->totalPrice = $this->totalPrice->add($money);
    }

    public function getTotalPrice(): ?Money
    {
        return $this->totalPrice;
    }

    // ...
}
