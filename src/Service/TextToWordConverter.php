<?php

declare(strict_types=1);

namespace App\Service;

class TextToWordConverter
{
    public const MIN_STRING_LEN = 3;

    public function convertToWord(string $text): \Generator
    {
        $words = preg_split('/[^A-Za-z]/', $text);

        foreach ($words as $word) {
            if (strlen($word) < static::MIN_STRING_LEN) {
                continue;
            }

            yield $word;
        }
    }
}
