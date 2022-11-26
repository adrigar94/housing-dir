<?php

namespace App\Shared\Infrastructure\Http\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse extends JsonResponse
{
    private function __construct(array $data, int $status, array $headers)
    {
        parent::__construct($data, $status, $headers);
    }

    static public function createResponse(array $data, int $status = JsonResponse::HTTP_OK, array $headers = ['content-type' => 'application/json'])
    {
        return new static($data,$status,$headers);
    }

    static public function createResponseOK(array $data, array $headers = ['content-type' => 'application/json'])
    {
        return new static($data,JsonResponse::HTTP_OK,$headers);
    }

    static public function createResponseCreated(array $data, array $headers = ['content-type' => 'application/json'])
    {
        return new static($data,JsonResponse::HTTP_CREATED,$headers);
    }
}
