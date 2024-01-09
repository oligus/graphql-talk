<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Nodes;

use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\AppContext;

class Album implements Node
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $result = $context->getJsonDB()
            ->select('*')
            ->from('albums.json')
            ->where(['id' => $args['id']])
            ->get();

        if (empty($result)) {
            throw new Exception('Album not found.');
        }

        return self::resolveFields(current($result), $context);
    }

    public static function resolveFields(array $item, AppContext $context): array
    {
        return [
            'id' => $item['id'],
            'title' => $item['title'],
            'artist' => function() use ($item, $context) {
                $result = $context->getJsonDB()
                    ->select('*')
                    ->from('artists.json')
                    ->where(['id' => $item['artistId']])
                    ->get();

                return !empty($result)
                    ? Artist::resolveFields(current($result), $context)
                    : null;
            },
            'tracks' => function(array $rootValue, array $args) use ($item, $context) {
                $result = $context->getJsonDB()
                    ->select('*')
                    ->from('tracks.json')
                    ->where(['albumId' => $item['id']])
                    ->get();

                $result = array_slice($result, $args['after'] ?? 0, $args['first'] ?? null);
                $nodes = [];

                foreach ($result as $item) {
                    $nodes[] = Track::resolveFields($item, $context);
                }

                return $nodes;
            }
        ];
    }
}
