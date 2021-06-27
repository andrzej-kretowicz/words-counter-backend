<?php

namespace App\Tests;

use App\Entity\User;
use App\Entity\Word;
use App\Repository\Interfaces\UserRepositoryInterace;
use App\Repository\Interfaces\WordRepositoryInterface;
use App\Service\UserProvider;
use App\Service\WordsProvider;
use PHPUnit\Framework\TestCase;

class WordsProviderTest extends TestCase
{
    public function testWhenUserExists(): void
    {
        $wordsRepository = $this->getMockBuilder(WordRepositoryInterface::class)
            ->getMock();
        $wordsRepository
            ->method('findWordIfExist')
            ->willReturn(new Word());
        $wordsRepository
            ->expects($this->once())
            ->method('save');

        $service = new WordsProvider($wordsRepository);

        $service->processWord('test', new User());
    }

    public function testWhenUserNotExists(): void
    {
        $wordsRepository = $this->getMockBuilder(WordRepositoryInterface::class)
            ->getMock();
        $wordsRepository
            ->method('findWordIfExist')
            ->willReturn(null);
        $wordsRepository
            ->expects($this->once())
            ->method('save');

        $service = new WordsProvider($wordsRepository);

        $service->processWord('test', new User());
    }
}
