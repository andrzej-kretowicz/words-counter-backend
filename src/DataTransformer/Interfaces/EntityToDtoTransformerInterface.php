<?php

declare(strict_types=1);

namespace App\DataTransformer\Interfaces;

use App\Dto\Interfaces\ResponseDtoInterface;

interface EntityToDtoTransformerInterface
{
    public function supports(object $entity): bool;

    public function transform(object $entity, int $entityNumber): ResponseDtoInterface;
}
