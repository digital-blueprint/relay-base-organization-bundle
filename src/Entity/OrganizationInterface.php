<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Entity;

use Dbp\Relay\CoreBundle\Entity\NamedEntityInterface;

interface OrganizationInterface extends NamedEntityInterface
{
    public function setIdentifier(string $identifier): void;

    public function getIdentifier(): ?string;

    public function getName(): ?string;

    public function setName(string $name): void;
}
