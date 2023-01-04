<?php

namespace App\Api\RentalProperty;

use App\Catalog\RentalProperty\Application\Find\FindRentalPropertyQuery;
use App\Catalog\RentalProperty\Application\Find\FindRentalPropertyResponse;
use App\Shared\Infrastructure\Http\Response\ApiResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class RentalPropertyFindController extends ApiController
{

    public function __invoke(string $id): JsonResponse
    {
        $query = new FindRentalPropertyQuery($id);

        /** @var FindRentalPropertyResponse $response */
        $response = $this->ask($query);

        return ApiResponse::createResponseOK([
            'status' => 'ok',
            'data' => $response->value()
        ]);
    }
}
