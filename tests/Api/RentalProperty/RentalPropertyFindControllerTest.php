<?php

declare(strict_types=1);

namespace tests\Api\RentalProperty;

use App\Tests\Api\AuthenticatedControllerTest;
use Symfony\Component\HttpFoundation\JsonResponse;

class RentalPropertyFindControllerTest extends AuthenticatedControllerTest
{
    private const ENDPOINT = '/api/rental-property/%s';
    private const ID_RENTAL_PROPERTY = '926126de-8d1c-11ed-a1eb-0242ac120002';
    private const ID_RENTAL_PROPERTY_NON_EXISTENT = '09278955-5662-4223-afcb-75a16a72df31';

    /** @test */
    public function it_should_find_rental_property(): void
    {
        $endpoint = sprintf(self::ENDPOINT, self::ID_RENTAL_PROPERTY);

        $response = $this->getRequest($endpoint);
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertEquals(self::ID_RENTAL_PROPERTY, $content['data']['id']);
        $this->assertArrayHasKey("description", $content['data']);
    }

    /** @test */
    public function it_should_not_found_rental_property(): void
    {
        $endpoint = sprintf(self::ENDPOINT, self::ID_RENTAL_PROPERTY_NON_EXISTENT);

        $response = $this->getRequest($endpoint);
        $content = json_decode($response->getContent(), true);
        
        $this->assertEquals(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
    }
}