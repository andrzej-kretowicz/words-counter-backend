<?php

declare(strict_types=1);

namespace App\Dto\Interfaces;

interface RequestDtoInterface
{
    public function set(string $name, mixed $value): void;
}
