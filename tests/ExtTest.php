<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class ExtTest extends ApiTestCase
{
    public function testAuthChecks()
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
}
