<?php

declare(strict_types=1);

namespace InITWorld\CanNotWriteTestToMethodUsingStaticMethod\Exercises\One;

class UsersRepository
{
    public function addUser(string $login, string $password): bool
    {
        // hashowanie hasła, zapis do bazy

        return true;
    }

    public function findUserByLogin(string $login): ?User
    {
        return null;
    }
}