<?php

namespace App\Controller;

use App\Dto\TextInputDto;
use App\Service\WordsCounterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WordsFormController extends AbstractController
{
    public function __construct(
        private WordsCounterService $counterService
    ) {}

    #[Route('/words', name: 'words_form', methods: ['POST'])]
    public function __invoke(TextInputDto $inputDto): iterable
    {
        return $this->counterService->countWords($inputDto->text, $this->getUser());
    }
}
