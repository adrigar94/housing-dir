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
        if ('application/json' !== $request->headers->get('Content-Type')) {
            return;
        }

        $exception = $event->getThrowable();
        
        $data = [
            'class' => \get_class($exception),
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'traces' => $exception->getTrace()
        ];

        if($data['code'] === 0 AND $exception instanceof HttpExceptionInterface){
            $data['code'] = $exception->getStatusCode();
        }elseif($data['code'] === 0){
            $data['code'] = JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        }
        
        $event->setResponse($this->prepareResponse($data));
    }

    private function prepareResponse(array $data): JsonResponse
    {
        return new JsonResponse($data, $data['code']);
    }
}
