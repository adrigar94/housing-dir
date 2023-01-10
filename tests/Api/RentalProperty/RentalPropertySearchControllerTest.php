<?php

declare(strict_types=1);

namespace tests\Api\RentalProperty;

use App\Tests\Api\AuthenticatedControllerTest;
use Symfony\Component\HttpFoundation\JsonResponse;

class RentalPropertySearchControllerTest extends AuthenticatedControllerTest
{

    private const ENDPOINT = '/api/rental-property';

    /** @test */
    public function it_should_search_all_rental_property(): void
    {
        $endpoint = self::ENDPOINT;

        $response = $this->getRequest($endpoint);
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertCount(2, $content['data']);
    }


    /** @test */
    public function it_should_search_rental_property(): void
    {
        $title = "Apartamento en el casco antiguo";
        $endpoint = sprintf("%s?title=%s", self::ENDPOINT, urlencode($title));

        $response = $this->getRequest($endpoint);
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertCount(1, $content['data']);
        $this->assertEquals($content['data'][0]['title'], $title);

        $this->markTestIncomplete("the rest of the filters are missing");
    }
}
