<?php

declare(strict_types=1);

namespace App\Adapter\Primary\Http\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Response transformer to make debugging easier.
 */
class ExceptionListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['onKernelException', 1],
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $status = $this->getStatusCode($exception);

        $event->setResponse(new JsonResponse(
            [
                'message' => $exception->getMessage(),
                'status' => $status,
                'success' => false,
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace(),
            ],
            $status,
        ));
    }

    protected function getStatusCode(\Throwable $exception): int
    {
        // HttpExceptionInterface is a special exception because it holds status code differently
        if ($exception instanceof HttpExceptionInterface) {
            return $exception->getStatusCode();
        }

        return $exception->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}