<?php

declare(strict_types=1);

namespace App\Dto;

trait SetDataTrait
{
    public function set(string $name, mixed $value): void
    {
        $vars = get_class_vars($this::class);

        if (!in_array($name, array_keys($vars))) {
            return;
        }

        $this->{$name} = $value;
    }
}
