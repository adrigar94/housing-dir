<?php

namespace App\Api\RentalProperty;

use App\Catalog\RentalProperty\Application\Create\CreateRentalPropertyCommand;
use App\Catalog\RentalProperty\Application\Create\RentalPropertyCreator;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyCommonCharacteristics;
use App\Catalog\Shared\Domain\Property\PropertyDescription;
use App\Catalog\Shared\Domain\Property\PropertyGallery;
use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Catalog\Shared\Domain\Property\PropertyLocation;
use App\Catalog\Shared\Domain\Property\PropertyPrice;
use App\Catalog\Shared\Domain\Property\PropertyTitle;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\ValueObject\BoolValueObject;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Http\Response\ApiResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RentalPropertyCreateController
{
    public function __construct(
        private CommandBus $commandBus
    ) {
    }

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

        $this->commandBus->dispatch($command);

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
