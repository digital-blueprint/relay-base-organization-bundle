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
 *             "openapi_context" = {
 *                 "tags" = {"BaseOrganization"},
 *                 "parameters" = {
 *                     {"name" = "person", "in" = "query", "description" = "Get organizations of a person (ID of BasePerson resource)", "required" = false, "type" = "string", "example" = "woody007"},
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"},
 *                     {"name" = "includeLocal", "in" = "query", "description" = "Local data attributes to include", "type" = "string", "example" = "BaseOrganization.code"}
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
}
