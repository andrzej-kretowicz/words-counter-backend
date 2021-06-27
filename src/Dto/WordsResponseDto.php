<?php

declare(strict_types=1);

namespace App\Dto;

use App\Dto\Interfaces\ResponseDtoInterface;

final class WordsResponseDto implements ResponseDtoInterface
{
    public string $word;

    public int $count;

    public int $stars;

    public function toArray(): array
    {
        return [
            'word' => $this->word,
            'count' => $this->count,
            'stars' => $this->stars,
        ];
    }
}
