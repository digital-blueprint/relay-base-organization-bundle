<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Tests;

use Dbp\Relay\BaseOrganizationBundle\Entity\Organization;
use PHPUnit\Framework\TestCase;

class OrganizationTest extends TestCase
{
    public function testBasics()
    {
        $org = new Organization();
        $this->assertNull($org->getIdentifier());
        $this->assertNull($org->getName());

        $org->setIdentifier('id');
        $this->assertSame('id', $org->getIdentifier());
        $org->setName('name');
        $this->assertSame('name', $org->getName());
    }
}
