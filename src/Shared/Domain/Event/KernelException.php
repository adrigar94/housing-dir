<?php

namespace App\Shared\Domain\Event;

use Exception;
use RuntimeException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class KernelException
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $request   = $event->getRequest();
        // if ('application/json' !== $request->headers->get('Content-Type')) {
        //     return;
        // }

        $exception = $event->getThrowable();

        $data = [
            'class' => \get_class($exception),
            'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $exception->getMessage(),
            'traces' => $exception->getTrace()
        ];
        
        if ($exception instanceof Exception
        ) {
            $data = [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];
        }
        
        $event->setResponse($this->prepareResponse($data));
    }

    private function prepareResponse(array $data): JsonResponse
    {
        return new JsonResponse($data, $data['code']);
    }
}
