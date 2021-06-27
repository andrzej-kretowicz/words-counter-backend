<?php

declare(strict_types=1);

namespace App\Dto\Interfaces;

interface ResponseDtoInterface
{
    public function toArray(): array;
}
