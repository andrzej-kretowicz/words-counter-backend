<?php

declare(strict_types=1);

namespace App\Entity\Interfaces;

use App\Entity\User;

interface UserAwareInterface
{
    public function setUser(User $user);

    public function getUser(): User;
}
