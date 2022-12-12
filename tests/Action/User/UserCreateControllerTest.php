<?php

namespace App\Tests\Action\User;

use App\Action\ControllerTest;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserCreateControllerTest extends ControllerTest
{
    
    use RefreshDatabaseTrait;
    
    private const ENDPOINT = '/api/user';

    /** @test */
    public function it_should_create_user(): void
    {
        $payload = [
            'name' => 'Adrián',
            'email' => 'adri@gmail.com',
            'password' => 'pass123',
        ];

        $response = $this->request(self::ENDPOINT, $payload);
        
        $this->assertEquals(JsonResponse::HTTP_CREATED,$response->getStatusCode());
    }
}
