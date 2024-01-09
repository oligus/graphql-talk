<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Lists;

use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\AppContext;
use Oligus\GraphqlTalk\Nodes\Album;

class Albums
{
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $result = $context->getJsonDB()
            ->select('*')
            ->from('albums.json')
            ->get();

        $result = array_slice($result, $args['after'] ?? 0, $args['first'] ?? null);
        $nodes = [];

        foreach ($result as $item) {
            $nodes[] = Album::resolveFields($item, $context);
        }

        return $nodes;
    }
}
