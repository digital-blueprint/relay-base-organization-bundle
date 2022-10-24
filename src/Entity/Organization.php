<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareInterface;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareTrait;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get" = {
 *             "path" = "/base/organizations",
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "pagination_client_partial" = true,
 *             "openapi_context" = {
 *                 "tags" = {"BaseOrganization"},
 *                 "parameters" = {
 *                     {"name" = "search", "in" = "query", "description" = "Search filter (partial, case-insensitive text search on 'name' attribute)", "type" = "string", "required" = false},
 *                     {"name" = "person", "in" = "query", "description" = "DEPRECATE: Get organizations of a person (ID of BasePerson resource)", "type" = "string", "required" = false},
 *                     {"name" = "queryLocal", "in" = "query", "description" = "Local query parameters to apply", "type" = "string"},
 *                     {"name" = "includeLocal", "in" = "query", "description" = "Local data attributes to include", "type" = "string", "example" = "BaseOrganization.code"},
 *                     {"name" = "partialPagination", "in" = "query", "description" = "Partial pagination", "type" = "bool", "example" = "false"}
 *                 }
 *             }
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "path" = "/base/organizations/{identifier}",
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "openapi_context" = {
 *                 "tags" = {"BaseOrganization"},
 *                 "parameters" = {
 *                     {"name" = "identifier", "in" = "path", "description" = "Resource identifier", "required" = true, "type" = "string", "example" = "1190"},
 *                     {"name" = "includeLocal", "in" = "query", "description" = "Local data attributes to include", "type" = "string", "example" = "BaseOrganization.code"}
 *                 }
 *             }
 *         },
 *     },
 *     iri="http://schema.org/Organization",
 *     shortName="BaseOrganization",
 *     description="An organization",
 *     normalizationContext={
 *         "jsonld_embed_context" = true,
 *         "groups" = {"BaseOrganization:output", "LocalData:output"}
 *     }
 * )
 */
class Organization implements OrganizationInterface, LocalDataAwareInterface
{
    use LocalDataAwareTrait;
    use OrganizationTrait;

    public const SEARCH_PARAMETER_NAME = 'search';
}
