<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation\Groups;

trait OrganizationTrait
{
    /**
     * @Groups({"BaseOrganization:output"})
     * @ApiProperty(identifier=true)
     *
     * @var string
     */
    private $identifier;

    /**
     * @Groups({"BaseOrganization:output"})
     * @ApiProperty(iri="https://schema.org/name")
     *
     * @var string
     */
    private $name;

    /**
     * @Groups({"BaseOrganization:output"})
     * @ApiProperty(iri="https://schema.org/url")
     *
     * @var string
     */
    private $url;

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}
