<?php

declare(strict_types=1);

namespace App\Tests\Api\RentalProperty;

use App\Tests\Api\AuthenticatedControllerTest;
use Symfony\Component\HttpFoundation\JsonResponse;

class RentalPropertyCreateControllerTest extends AuthenticatedControllerTest
{
    private const ENDPOINT = '/api/rental-property';

    /** @test */
    public function it_should_create_rental_property(): void
    {
        $payload = [
            "title" => "Loft en el centro",
            "description" => "Loft en el centro para solteros",
            "characteristics" => [
                "constructionCharacterisitcs" => [
                    "rooms" => 3,
                    "bathrooms" => 1,
                    "typeConstruction" => "home",
                    "contructedArea" => 90,
                    "livingArea" => 90,
                    "plotArea" => 100,
                    "age" => 14,
                    "conservation" => "good",
                    "floor" => 2,
                    "orientation" => [
                        "0" => "south"
                    ],
                    "hasLift" => false
                ],
                "equipmentCharacterisitcs" => [
                    "isFurnished" => false,
                    "hasGarage" => false,
                    "hasHeating" => 1,
                    "typeHeating" => "natural_gas",
                    "hasAirConditioning" => 1,
                    "hasGarden" => false,
                    "hasPool" => 1,
                ],
                "energyCharacterisitcs" => [
                    "consumption" => [
                        "value" => 100,
                        "rating" => "c",
                    ],
                    "emissions" => [
                        "value" => 200,
                        "rating" => "d"
                    ]
                ]
            ],
            "location" => [
                "country" => "España",
                "region" => "Cataluña",
                "city" => "Blanes",
                "address" => "C/ Pablo Neruda, 8, 2o 2a",
            ],
            "gallery" => [
                "0" => [
                    "url_thumbnail" => "/images/12321321-thumb.jpg",
                    "url_tiny" => "/images/12321321-tiny.jpg",
                    "url_medium" => "/images/12321321-medium.jpg",
                    "url_large" => "/images/12321321-large.jpg",
                    "title" => "Cocina del apartamento en la playa",
                    "alt" => "Cocina del apartamento en la playa",
                ],
                "1" => [
                    "url_thumbnail" => "/images/3434343434-thumb.jpg",
                    "url_tiny" => "/images/3434343434-tiny.jpg",
                    "url_medium" => "/images/3434343434-medium.jpg",
                    "url_large" => "/images/3434343434-large.jpg",
                    "title" => "Habitacion del apartamento en la playa",
                    "alt" => "Habitacion del apartamento en la playa",
                ]
            ],
            "price_month" => [
                "price_cents" => 50000,
                "currency" => "€",
            ],
            "pets_allowed" => 1
        ];

        $response = $this->request(self::ENDPOINT, $payload);
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());
        $this->assertArrayHasKey("id", $content);
    }
}
