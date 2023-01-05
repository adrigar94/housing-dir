<?php

namespace App\Tests\Api;

use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class ControllerTest extends WebTestCase
{
    use RefreshDatabaseTrait;

    protected static ?KernelBrowser $baseClient = null;

    public function setUp(): void
    {
        parent::setUp();
        if (self::$baseClient === null) {
            self::$baseClient = static::createClient();
        }
    }

    protected function request(string $endpoint, array $payload, string $method = Request::METHOD_POST): Response
    {
        self::$baseClient->request($method, $endpoint, [], [], [], json_encode($payload));
        return self::$baseClient->getResponse();
    }

    protected function getRequest(string $endpoint): Response
    {
        self::$baseClient->request(Request::METHOD_GET, $endpoint, [], [], []);
        return self::$baseClient->getResponse();
    }
}
