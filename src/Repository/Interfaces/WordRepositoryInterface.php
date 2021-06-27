<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

use App\Entity\Interfaces\UserInterface;
use App\Entity\User;
use App\Entity\Word;

interface WordRepositoryInterface
{
    public function findWordIfExist(string $word, UserInterface $user): ?Word;

    public function save(Word $word): void;

    public function findByUser(User $user);
}
