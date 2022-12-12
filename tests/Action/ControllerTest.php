<?php

namespace App\Action;

use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class ControllerTest extends WebTestCase
{
    protected static ?KernelBrowser $baseClient = null;
    
    public function setUp():void
    {
        parent::setUp();
        if(self::$baseClient === null){
            self::createAuthenticatedClient(self::$baseClient);
        }
    }

    protected static function createAuthenticatedClient(): void
    {
        self::$baseClient = static::createClient();

        $encoder = self::$baseClient->getContainer()->get(JWTEncoderInterface::class);

        self::$baseClient->setServerParameters([
            'CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'application/json',
            'HTTP_Authorization' => sprintf('Bearer %s', $encoder->encode([
                'username' => 'adri@testing.com',
                'exp' => time() + 3600
            ]))
        ]);
    }

    protected function request(string $endpoint, array $payload): Response
    {
        self::$baseClient->request(Request::METHOD_POST, $endpoint, [], [], [], json_encode($payload));
        return self::$baseClient->getResponse();
    }
}
