<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

use App\Entity\User;

interface UserRepositoryInterace
{
    public function findUserByIp(string $ip): ?User;

    public function saveUser(User $user): void;
}
