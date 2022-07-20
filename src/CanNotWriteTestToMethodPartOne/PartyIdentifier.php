<?php

declare(strict_types=1);

namespace InITWorld\CanNotWriteTestToMethodPartOne;

class PartyIdentifier
{
    public function __construct(
        private readonly string $identifier
    ) {
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}
