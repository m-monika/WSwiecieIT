<?php

declare(strict_types=1);

namespace InITWorld\CanNotWriteTestToMethodUsingStaticMethod\Exercises\One;

class ManageUser
{
    public function __construct(private UsersRepository $repository)
    {
    }

    public function addUser(string $login, string $password): bool
    {
        if (!$this->isValidLogin($login)) {
            throw new \InvalidArgumentException("Invalid login. Login can contain only small letters, min:3, max:20");
        }

        if ($this->repository->findUserByLogin($login) !== null) {
            throw new \InvalidArgumentException("Login is already taken");
        }

        if (!$this->isValidPassword($password)) {
            throw new \InvalidArgumentException(
                "Password must be at least 8 characters in length and must contain at least one number,"
                . " one upper case letter, one lower case letter and one special character"
            );
        }

        if (!$this->repository->addUser($login, $password)) {
            $exception = new \RuntimeException(sprintf("Unable to add user %s", $login));
            Sentry::catchException($exception);
            throw $exception;
        }

        return Notifier::notify("Add new user, {$login}");
    }

    private function isValidLogin(string $login): bool
    {
        return preg_match('/^[a-z]{3,20}$/', $login) !== false;
    }

    private function isValidPassword(string $password): bool
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        return $uppercase && $lowercase && $number && $specialChars && strlen($password) >= 8;
    }
}