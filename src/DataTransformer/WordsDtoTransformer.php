<?php

declare(strict_types=1);

namespace App\DataTransformer;

use App\DataTransformer\Interfaces\EntityToDtoTransformerInterface;
use App\Dto\Interfaces\ResponseDtoInterface;
use App\Dto\WordsResponseDto;
use App\Entity\Word;

class WordsDtoTransformer implements EntityToDtoTransformerInterface
{
    private const NUMBER_OF_STARS = 3;

    public function supports(object $entity): bool
    {
        return $entity instanceof Word;
    }

    public function transform(object $entity, int $entityNumber): ResponseDtoInterface
    {
        $response = new WordsResponseDto();
        $response->word = $entity->getWord();
        $response->count = $entity->getCount();

        $stars = static::NUMBER_OF_STARS - ($entityNumber - 1);

        $response->stars = $stars > 0 ? $stars : 0;

        return $response;
    }
}
