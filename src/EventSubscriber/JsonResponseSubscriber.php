<?php

namespace App\EventSubscriber;

use App\DataTransformer\EntityToDtoTransformer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class JsonResponseSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private EntityToDtoTransformer $dtoTransformer
    ) {}

    public function onKernelView(ViewEvent $event)
    {
        $result = $event->getControllerResult();

        if (!is_iterable($result)) {
            return $result;
        }

        $data = [];

        foreach ($this->dtoTransformer->transformIterable($result) as $dto) {
            $data[] = $dto->toArray();
        }

        $response = new JsonResponse($data, Response::HTTP_OK);


        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.view' => 'onKernelView',
        ];
    }
}
