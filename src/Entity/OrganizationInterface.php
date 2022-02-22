<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Entity;

interface OrganizationInterface
{
    public function setIdentifier(string $identifier): void;

    public function getIdentifier(): ?string;

    public function getName(): ?string;

    public function setName(string $name): void;

    public function getUrl(): ?string;

    public function setUrl(string $url): void;
}
