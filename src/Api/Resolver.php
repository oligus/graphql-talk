<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api;

use GraphQL\Type\Definition\ResolveInfo;

/**
 * Interface Resolver
 * @package Oligus\GraphqlTalk\GraphQL
 */
interface Resolver
{
    /**
     * @param array<mixed> $rootValue
     * @param array<mixed> $args
     * @return array<mixed>
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array;
}
