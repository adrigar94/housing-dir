<?php

namespace App\Api\RentalProperty;

use App\Catalog\RentalProperty\Application\Create\CreateRentalPropertyCommand;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Http\Response\ApiResponse;
use Symfony\Component\HttpFoundation\Request;

class RentalPropertyCreateController extends ApiController
{
    public function __invoke(Request $request): ApiResponse
    {
        $data = json_decode($request->getContent(), true);

        $id = Uuid::random();
        $command = new CreateRentalPropertyCommand(
            $id,
            $data['title'],
            $data['description'],
            $data['characteristics'] ?? [],
            $data['location'] ?? [],
            $data['gallery'] ?? [],
            $data['price_month'] ?? [],
            isset($data['pets_allowed']) ? $data['pets_allowed'] : null
        );

        $this->dispatch($command);

        return ApiResponse::createResponseCreated(
            [
                'status' => 'ok',
                'time' => new \DateTime(),
                'id' => $id,
                'title' => $data['title']
            ]
        );
    }
}
