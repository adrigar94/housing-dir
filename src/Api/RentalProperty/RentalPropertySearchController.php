<?php

namespace App\Api\RentalProperty;

use App\Api\ApiController;
use App\Catalog\RentalProperty\Application\SearchByCriteria\SearchRentalPropertyQuery;
use App\Catalog\RentalProperty\Application\SearchByCriteria\SearchRentalPropertyResponse;
use App\Shared\Infrastructure\Http\Response\ApiResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RentalPropertySearchController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        $params = $request->query->all();


        $filters = $this->getFilters($request);
        $order = $this->getOrder($request);
        $offset = $request->get('offset');
        $limit = $request->get('limit');

        $query = new SearchRentalPropertyQuery($filters, $order, $offset, $limit);

        /** @var SearchRentalPropertyResponse $response */
        $response = $this->ask($query);

        return ApiResponse::createResponseOK([
            'status' => 'ok',
            'data' => $response->items()
        ]);
    }

    private function getFilters(Request $request): array
    {
        $filters = [];

        $allowedFilters = ['id', 'title'];
        // TODO remaining filters

        foreach ($allowedFilters as $filter) {
            $value = $request->get($filter);
            if ($value) {
                $filters[] = [
                    'name' => $filter,
                    'operator' => '=',
                    'value' => $value
                ];
            }
        }

        return $filters;
    }
    private function getOrder(Request $request): array
    {
        $field = $request->get('orderField');
        $type = $request->get('orderType');

        return [
            'field' => $field,
            'type' => $type
        ];
    }
}
