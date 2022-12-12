<?php

namespace App\Tests\Action;

use App\Auth\User\Domain\UserEmail;
use App\Auth\User\Domain\UserRepository;
use App\Tests\Action\ControllerTest;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

abstract class AuthenticatedControllerTest extends ControllerTest
{
    protected static bool $baseClientAuthenticated = false;

    public function setUp(): void
    {
        parent::setUp();
        if (self::$baseClientAuthenticated === false) {
            self::createAuthenticatedClient(self::$baseClient);
        }
    }

    private static function createAuthenticatedClient(): void
    {

        $user = self::$baseClient->getContainer()->get(UserRepository::class)->findByEmail(new UserEmail('adri@testing.com'));
        $token = self::$baseClient->getContainer()->get(JWTTokenManagerInterface::class)->create($user);


        self::$baseClient->setServerParameters([
            'CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'application/json',
            'HTTP_Authorization' => sprintf('Bearer %s', $token)
        ]);

        self::$baseClientAuthenticated = true;
    }
}
