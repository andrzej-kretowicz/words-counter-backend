<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\Interfaces\UserRepositoryInterace;

class UserProvider
{
    public function __construct(
        private UserRepositoryInterace $userRepository
    ) {}

    public function createIfNotExists(string $ip): User
    {
        $user = $this->userRepository->findUserByIp($ip);

        if (null === $user) {
            $user = $this->createNewUser($ip);
        }

        return $user;
    }

    private function createNewUser(string $ip): User
    {
        $user = new User();
        $user->setIp($ip);

        $this->userRepository->saveUser($user);

        return $user;
    }
}
