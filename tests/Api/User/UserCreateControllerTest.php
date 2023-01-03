<?php

namespace App\Tests\Api\User;

use App\Tests\Api\AuthenticatedControllerTest;
use App\Auth\User\Domain\InvalidEmailException;
use App\Auth\User\Domain\InvalidUserPasswordMinLengthException;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserCreateControllerTest extends AuthenticatedControllerTest
{
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
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());
        $this->assertArrayHasKey("id", $content);
    }

    /** @test */
    public function it_should_fail_create_user_because_email_is_invalid(): void
    {
        $payload = [
            'name' => 'Adrián',
            'email' => 'adrigmail.com',
            'password' => 'pass123',
        ];

        $response = $this->request(self::ENDPOINT, $payload);
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(InvalidEmailException::Code, $response->getStatusCode());
        $this->assertContains(InvalidEmailException::Message, $content);
    }


    /** @test */
    public function it_should_fail_create_user_because_password_is_short(): void
    {
        $payload = [
            'name' => 'Adrián',
            'email' => 'adri@gmail.com',
            'password' => 'pass',
        ];

        $response = $this->request(self::ENDPOINT, $payload);
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(InvalidUserPasswordMinLengthException::Code, $response->getStatusCode());
        $this->assertContains(InvalidUserPasswordMinLengthException::Message, $content);
    }
}
