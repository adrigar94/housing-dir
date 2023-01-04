<?php

namespace App\Api\RentalProperty;

use App\Catalog\RentalProperty\Application\Find\FindRentalPropertyQuery;
use App\Catalog\RentalProperty\Application\Find\FindRentalPropertyResponse;
use App\Catalog\RentalProperty\Application\Find\RentalPropertyFinder;
use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Infrastructure\Http\Response\ApiResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class RentalPropertyFindController
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(string $id): JsonResponse
    {
        $query = new FindRentalPropertyQuery($id);

        /** @var FindRentalPropertyResponse $response */
        $response = $this->queryBus->ask($query);

        return ApiResponse::createResponseOK([
            'status' => 'ok',
            'data' => $response->value()
        ]);
    }
}
