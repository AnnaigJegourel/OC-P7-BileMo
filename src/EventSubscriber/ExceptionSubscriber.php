<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{


    /**
     * Get Kernel exceptions
     *
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        // return;
        $exception = $event->getThrowable();
        // récupérer debug mode
        // if(debug) -> return directement, sinon...
        if ($exception instanceof HttpException) {
            $status = $exception->getStatusCode();
        } else {
            $status = 500;
        }

        $data = [
                 'status' => $status,
                 'message' => $exception->getMessage()
                ];
        $event->setResponse(new JsonResponse($data));

    }


    /**
     * Return Kernel Exception event
     *
     * @return array
     */
    // @phpstan-ignore-next-line
    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::EXCEPTION => 'onKernelException'];

    }


}
