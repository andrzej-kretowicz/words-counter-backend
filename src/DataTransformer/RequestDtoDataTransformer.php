<?php

declare(strict_types=1);

namespace App\DataTransformer;

use App\Dto\Interfaces\RequestDtoInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestDtoDataTransformer implements ArgumentValueResolverInterface
{
    public function __construct(
        private ValidatorInterface $validator
    ) {}

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        $class = $argument->getType();

        if (in_array(RequestDtoInterface::class, class_implements($class))) {
            return true;
        }

        return false;
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $class = $argument->getType();

        $dto = new $class;

        if (!$dto instanceof RequestDtoInterface) {
            return;
        }

        foreach ($request->request->all() as $key => $value) {
            $dto->set($key, $value);
        }

        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            throw new ValidationFailedException('Validation failed', $errors);
        }

        yield $dto;
    }
}
