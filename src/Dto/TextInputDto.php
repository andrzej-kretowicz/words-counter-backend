<?php

declare(strict_types=1);

namespace App\Dto;

use App\Dto\Interfaces\RequestDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class TextInputDto implements RequestDtoInterface
{
    use SetDataTrait;

    #[Assert\NotBlank]
    public string $text;
}
