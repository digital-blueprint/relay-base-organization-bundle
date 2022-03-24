<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;

trait OrganizationTrait
{
    /**
     * @ApiProperty(identifier=true)
     * @Groups({"BaseOrganization:output"})
     *
     * @var string
     */
    private $identifier;

    /**
     * @ApiProperty(iri="https://schema.org/name")
     * @Groups({"BaseOrganization:output"})
     *
     * @var string
     */
    private $name;

    /**
     * @ApiProperty(iri="https://schema.org/additionalProperty")
     * @Groups({"BaseCourse:output"})
     *
     * @var array
     */
    private $localData;

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

    public function getLocalData(): array
    {
        return $this->localData;
    }

    /**
     * Allows attaching local data to a Course object.
     *
     * @param ?mixed $value
     */
    public function setLocalDataValue(string $key, $value): void
    {
        if (!$this->localData) {
            $this->localData = [];
        }
        $this->localData[$key] = $value;
    }

    /**
     * @Ignore
     * Gets local data from a Course object.
     *
     * @return ?mixed
     */
    public function getLocalDataValue(string $key)
    {
        return $this->localData ? ($this->localData[$key] ?? null) : null;
    }
}
