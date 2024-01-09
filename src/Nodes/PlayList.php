<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Nodes;

use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\AppContext;

class PlayList implements Node
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $result = $context->getJsonDB()
            ->select('*')
            ->from('playlists.json')
            ->where(['id' => $args['id']])
            ->get();

        if (empty($result)) {
            throw new Exception('Play list not found.');
        }

        return self::resolveFields(current($result), $context);
    }

    public static function resolveFields(array $item, AppContext $context): array
    {
        return [
            'id' => $item['id'],
            'name' => $item['name'],
            'tracks' => function() use ($item, $context) {
                $result = $context->getJsonDB()
                    ->select('*')
                    ->from('playlist_track.json')
                    ->where(['playlistId' => $item['id']])
                    ->get();

                $result = array_slice($result, $args['after'] ?? 0, $args['first'] ?? 100);

                $nodes = [];

                foreach ($result as $link) {
                    $item = $context->getJsonDB()
                        ->select('*')
                        ->from('tracks.json')
                        ->where(['id' => $link['trackId']])
                        ->get();

                    if (!empty($item)) {
                        $nodes[] = Track::resolveFields(current($item), $context);
                    }
                }

                return $nodes;
            },
        ];
    }
}
