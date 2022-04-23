<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Nodes;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\DBAL\Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Api\Lists\Tracks;
use Oligus\GraphqlTalk\Modules\Album as AlbumEntity;
use Oligus\GraphqlTalk\Modules\Track as TrackEntity;

class Album extends Node
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        /** @var AlbumEntity $album */
        $album = $context->getEm()->getRepository(AlbumEntity::class)->find($args['id']);

        if (empty($album)) {
            throw new Exception('Album not found.');
        }

        return self::resolveFields($album);
    }


    public static function resolveFields(AlbumEntity $album): array
    {
        return [
            'id' => $album->id,
            'title' => $album->title,
            'artist' => function() use ($album) {
                return !empty($album->artist)
                    ? Artist::resolveFields($album->artist)
                    : null;
            },
            'tracks' => function(array $rootValue, array $args) use ($album) {
                $criteria = new Criteria();
                $criteria->setMaxResults($args['first'] ?? null);
                $criteria->setFirstResult($args['after'] ?? null);
                $tracks = $album->tracks->matching($criteria);
                return Tracks::resolveFields($tracks, TrackEntity::class, Track::class);
            },
        ];
    }
}
