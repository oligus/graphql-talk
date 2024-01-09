<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk;

use GraphQL\Type\Definition\ResolveInfo;

interface Resolver
{
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array;
}
