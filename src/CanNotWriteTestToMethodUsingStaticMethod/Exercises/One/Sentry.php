<?php

declare(strict_types=1);

namespace InITWorld\CanNotWriteTestToMethodUsingStaticMethod\Exercises\One;

abstract class Sentry
{
    public static function catchException(\Throwable $exception): void
    {
        // powiadomienie sentry o problemie
    }
}