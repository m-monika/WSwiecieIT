<?php

declare(strict_types=1);

namespace InITWorld\CanNotWriteTestToMethodUsingStaticMethod\Exercises\One;

abstract class Notifier
{
    public static function notify(string $message): bool
    {
        // wysłanie na kolejkę powiadomienia

        return true;
    }
}