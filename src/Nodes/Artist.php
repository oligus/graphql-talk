<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Nodes;

use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\AppContext;

class Artist implements Node
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $result = $context->getJsonDB()
            ->select('*')
            ->from('artists.json')
            ->where(['id' => $args['id']])
            ->get();

        if (empty($result)) {
            throw new Exception('Artist not found.');
        }

        return self::resolveFields(current($result), $context);
    }

    public static function resolveFields(array $item, $context): array
    {
        return [
            'id' => $item['id'],
            'name' => $item['name'],
            'albums' => function(array $rootValue, array $args) use ($item, $context) {
                $result = $context->getJsonDB()
                    ->select('*')
                    ->from('albums.json')
                    ->where(['artistId' => $item['id']])
                    ->get();

                $result = array_slice($result, $args['after'] ?? 0, $args['first'] ?? null);
                $nodes = [];

                foreach ($result as $item) {
                    $nodes[] = Album::resolveFields($item, $context);
                }

                return $nodes;
            },
        ];
    }
}
