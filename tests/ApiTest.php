<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Tests;

use Dbp\Relay\CoreBundle\TestUtils\AbstractApiTest;
use Symfony\Component\HttpFoundation\Response;

class ApiTest extends AbstractApiTest
{
    public function testGetRequestsOk()
    {
        foreach (['/base/organizations', '/base/organizations/foo'] as $path) {
            $this->testClient->setUpUser(userAttributes: ['MAY_READ' => true]);
            $response = $this->testClient->get($path);
            $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        }
    }

    public function testGetRequestsUnauthorized()
    {
        foreach (['/base/organizations', '/base/organizations/foo'] as $path) {
            $response = $this->testClient->get($path, token: null);
            $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
        }
    }

    public function testGetRequestsForbidden()
    {
        foreach (['/base/organizations', '/base/organizations/foo'] as $path) {
            $this->testClient->setUpUser(userAttributes: ['MAY_READ' => false]);
            $response = $this->testClient->get($path);
            $this->assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());
        }
    }
}
