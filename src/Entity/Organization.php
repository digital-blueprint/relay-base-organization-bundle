<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Dbp\Relay\BaseOrganizationBundle\Controller\GetOrganizationsByPerson;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get" = {
 *             "path" = "/base/organizations",
 *             "openapi_context" = {
 *                 "tags" = {"BaseOrganization"},
 *                 "parameters" = {
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"}
 *                 }
 *             }
 *         },
 *         "get_orgs" = {
 *             "method" = "GET",
 *             "path" = "/base/people/{identifier}/organizations",
 *             "controller" = GetOrganizationsByPerson::class,
 *             "read" = false,
 *             "openapi_context" = {
 *                 "tags" = {"BaseOrganization"},
 *                 "summary" = "Get the organizations related to a person.",
 *                 "parameters" = {
 *                     {"name" = "identifier", "in" = "path", "description" = "Id of person", "required" = true, "type" = "string", "example" = "vlts01"},
 *                     {"name" = "context", "in" = "query", "description" = "type of relation", "required" = false, "type" = "string", "example" = "library-manager"},
 *                     {"name" = "lang", "in" = "query", "description" = "language", "type" = "string", "example" = "en"},
 *                 }
 *             },
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "path" = "/base/organizations/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"BaseOrganization"},
 *                 "parameters" = {
 *                     {"name" = "identifier", "in" = "path", "description" = "orgUnitID of organization", "required" = true, "type" = "string", "example" = "1190-F2050"},
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"}
 *                     {"name" = "include", "in" = "query", "description" = "Optional resources to include ", "type" = "string", "example" = "localData"}
 *                 }
 *             }
 *         },
 *     },
 *     iri="http://schema.org/Organization",
 *     shortName="BaseOrganization",
 *     description="An organization",
 *     normalizationContext={
 *         "jsonld_embed_context" = true,
 *         "groups" = {"BaseOrganization:output"}
 *     }
 * )
 */
class Organization implements OrganizationInterface
{
    use OrganizationTrait;
}
