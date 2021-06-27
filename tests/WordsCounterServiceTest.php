<?php

namespace App\Tests;

use App\Entity\User;
use App\Entity\Word;
use App\Service\TextToWordConverter;
use App\Service\WordsCounterService;
use App\Service\WordsProvider;
use PHPUnit\Framework\TestCase;

class WordsCounterServiceTest extends TestCase
{
    /**
     * @dataProvider data
     */
    public function testCountWords(string $text, array $words, $num): void
    {
        $converter = $this->getMockBuilder(TextToWordConverter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $converter
            ->method('convertToWord')
            ->willReturn($this->toGenerator($words));

        $wordsProvider = $this->getMockBuilder(WordsProvider::class)
            ->disableOriginalConstructor()
            ->getMock();
        $wordsProvider
            ->method('processWord')
            ->willReturn(new Word());

        $counter = 0;

        $service = new WordsCounterService($converter, $wordsProvider);
        foreach ($service->countWords($text, new User()) as $word) {
            $this->assertInstanceOf(Word::class, $word);
            ++$counter;
        }

        $this->assertEquals($num, $counter);
    }

    public function toGenerator(array $data): \Generator
    {
        foreach ($data as $value) {
            yield $value;
        }
    }

    public function data(): \Generator
    {
        yield ['hello world', ['hello', 'world'], 2];
        yield ['abc', ['abc'], 1];
        yield ['test test test', ['test', 'test', 'test'], 3];
    }
}
