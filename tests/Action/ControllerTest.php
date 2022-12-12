<?php

namespace App\Tests\Action;

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

    protected function request(string $endpoint, array $payload): Response
    {
        self::$baseClient->request(Request::METHOD_POST, $endpoint, [], [], [], json_encode($payload));
        return self::$baseClient->getResponse();
    }
}
