<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\Parameter;
use Dbp\Relay\BaseOrganizationBundle\DataProvider\OrganizationDataProvider;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareInterface;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareTrait;
use Dbp\Relay\CoreBundle\Rest\Entity\NamedEntityInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    shortName: 'BaseOrganization',
    types: ['http://schema.org/Organization'],
    operations: [
        new Get(
            uriTemplate: '/base/organizations/{identifier}',
            openapi: new Operation(
                tags: ['BaseOrganization'],
                parameters: [
                    new Parameter(
                        name: 'includeLocal',
                        in: 'query',
                        description: 'Local data attributes to include',
                        schema: ['type' => 'string'],
                        example: 'code',
                    ),
                ]
            ),
            provider: OrganizationDataProvider::class
        ),
        new GetCollection(
            uriTemplate: '/base/organizations',
            openapi: new Operation(
                tags: ['BaseOrganization'],
                parameters: [
                    new Parameter(
                        name: 'search',
                        in: 'query',
                        description: "Search filter (partial, case-insensitive text search on 'name' attribute)",
                        required: false,
                        schema: ['type' => 'string'],
                    ),
                    new Parameter(
                        name: 'includeLocal',
                        in: 'query',
                        description: 'Local data attributes to include',
                        schema: ['type' => 'string'],
                        example: 'code',
                    ),
                ]
            ),
            provider: OrganizationDataProvider::class
        ),
    ],
    normalizationContext: [
        'groups' => ['BaseOrganization:output', 'LocalData:output'],
        'jsonld_embed_context' => true,
    ]
)]
class Organization implements LocalDataAwareInterface, NamedEntityInterface
{
    use LocalDataAwareTrait;

    public const SEARCH_PARAMETER_NAME = 'search';

    #[ApiProperty(identifier: true)]
    #[Groups(['BaseOrganization:output'])]
    private ?string $identifier = null;

    #[ApiProperty(iris: ['https://schema.org/name'])]
    #[Groups(['BaseOrganization:output'])]
    private ?string $name = null;

    public function setIdentifier(?string $identifier): void
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

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}
