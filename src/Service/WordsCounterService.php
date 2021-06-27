<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Interfaces\UserInterface;

class WordsCounterService
{
    public function __construct(
        private TextToWordConverter $converter,
        private WordsProvider $provider
    ) {}

    public function countWords(string $text, UserInterface $user): array
    {
        $results = [];

        foreach ($this->converter->convertToWord($text) as $word) {
            $results[] = $this->provider->processWord($word, $user);
        }

        return $results;
    }
}
