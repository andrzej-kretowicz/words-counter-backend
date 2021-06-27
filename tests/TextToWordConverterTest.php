<?php

namespace App\Tests;

use App\Service\TextToWordConverter;
use PHPUnit\Framework\TestCase;

class TextToWordConverterTest extends TestCase
{
    /**
     * @dataProvider data
     */
    public function testConvertToWord(string $words, int $results): void
    {
        $service = new TextToWordConverter();

        $counter = 0;

        foreach ($service->convertToWord($words) as $word) {
            ++$counter;
        }

        $this->assertEquals($results, $counter);
    }

    public function data(): \Generator
    {
        yield ['a', 0];
        yield ['abc', 1];
        yield ['Hello world!', 2];
    }
}
