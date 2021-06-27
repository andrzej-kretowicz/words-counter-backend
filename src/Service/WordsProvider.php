<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Interfaces\UserInterface;
use App\Entity\Word;
use App\Repository\Interfaces\WordRepositoryInterface;

class WordsProvider
{
    public function __construct(
        private WordRepositoryInterface $wordRepository
    ) {}

    public function processWord(string $input, UserInterface $user): Word
    {
        $word = $this->wordRepository->findWordIfExist($input, $user);

        if (null === $word) {
            $word = $this->createWord($input, $user);
        }

        $word->setCount($word->getCount() + 1);

        $this->wordRepository->save($word);

        return $word;
    }

    private function createWord(string $input, UserInterface $user): Word
    {
        return (new Word())
            ->setWord($input)
            ->setUser($user);
    }

    public function getUserWords(UserInterface $user): iterable
    {
        return $this->wordRepository->findByUser($user);
    }
}
