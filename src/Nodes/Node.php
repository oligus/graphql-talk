<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Nodes;

use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\AppContext;

interface Node
{
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array;
    public static function resolveFields(array $item, AppContext $context): array;
}
