<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseOrganizationBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
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
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "path" = "/base/organizations/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"BaseOrganization"},
 *                 "parameters" = {
 *                     {"name" = "identifier", "in" = "path", "description" = "Resource identifier", "required" = true, "type" = "string", "example" = "1190"},
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"},
 *                     {"name" = "include", "in" = "query", "description" = "Optional resources to include", "type" = "string", "example" = "localData"}
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
