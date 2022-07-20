<?php

declare(strict_types=1);

namespace InITWorld\CanNotWriteTestToMethodPartOne;

class CustomerDiscountRepository
{
    public function get(PartyIdentifier $identifier): ?int
    {
        // some connections to database ...

        return 10;
    }
}
