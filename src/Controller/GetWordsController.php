<?php

namespace App\Controller;

use App\Service\WordsProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GetWordsController extends AbstractController
{
    public function __construct(
        private WordsProvider $provider
    ) {}

    #[Route('/words', name: 'get_words', methods: ['GET'])]
    public function __invoke(): iterable
    {
        return $this->provider->getUserWords($this->getUser());
    }
}
