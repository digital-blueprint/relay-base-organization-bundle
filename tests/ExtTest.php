<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Dbp\Relay\CoreBundle\TestUtils\UserAuthTrait;
use Symfony\Component\HttpFoundation\Response;

class ExtTest extends ApiTestCase
{
    use UserAuthTrait;

    public function testRequestsUnauthenticated()
    {
        $client = self::createClient();

        $endpoints = [
            '/base/organizations',
            '/base/organizations/foo',
        ];
        foreach ($endpoints as $path) {
            $response = $client->request('GET', $path);
            $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
        }
    }

    public function testGetItemAuthenticated()
    {
        $this->testRequestAuthenticated('/base/organizations/foo');
    }

    public function testGetCollectionAuthenticated()
    {
        $this->testRequestAuthenticated('/base/organizations');
    }

    private function testRequestAuthenticated(string $url)
    {
        $client = $this->withUser('user', [], '42');
        $response = $client->request('GET', $url, ['headers' => [
            'Authorization' => 'Bearer 42',
        ]]);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
