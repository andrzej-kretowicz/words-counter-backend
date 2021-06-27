<?php

declare(strict_types=1);

namespace App\DataTransformer;

use App\DataTransformer\Interfaces\EntityToDtoTransformerInterface;

class EntityToDtoTransformer
{
    private array $transformers;

    public function __construct(
        EntityToDtoTransformerInterface ...$transformers
    ) {
        $this->transformers = $transformers;
    }


    public function transformIterable(iterable $data): \Generator
    {
        $counter = 0;

        foreach ($data as $entity) {
            foreach ($this->transformers as $dtoTransformer) {
                if ($dtoTransformer->supports($entity)) {
                    yield $dtoTransformer->transform($entity, ++$counter);
                }
            }
        }
    }
}
