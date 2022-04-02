<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Lists;

use Doctrine\Common\Collections\ArrayCollection;
use Oligus\GraphqlTalk\Api\Resolver;

/**
 * Class AbstractListResolver
 * @package Oligus\GraphqlTalk\GraphQL\Lists
 */
abstract class AbstractListResolver implements Resolver
{
    public static function resolveFields(iterable $items, string $entityClass, string $nodeClass): array
    {
        $nodes = new ArrayCollection();

        foreach ($items as $item) {
            $nodes->add($nodeClass::resolveFields($item));
        }

        return $nodes->toArray();
    }
}
