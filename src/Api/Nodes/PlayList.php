<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Nodes;

use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Api\Lists\Tracks;
use Oligus\GraphqlTalk\Modules\Playlist as PlayListEntity;
use Oligus\GraphqlTalk\Modules\Track as TrackEntity;

class PlayList extends Node
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        /** @var PlayListEntity $playlist */
        $playlist = $context->getEm()->getRepository(PlayListEntity::class)->find($args['id']);

        if (empty($playlist)) {
            throw new Exception('Play list not found.');
        }

        return self::resolveFields($playlist);
    }


    public static function resolveFields(PlayListEntity $playlist): array
    {
        return [
            'id' => $playlist->id,
            'name' => $playlist->name,
            'tracks' => function() use ($playlist) {
                return !empty($playlist->tracks)
                    ? Tracks::resolveFields($playlist->tracks, TrackEntity::class, Track::class)
                    : null;
            },
        ];
    }
}
