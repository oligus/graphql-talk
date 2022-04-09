<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Nodes;

use Doctrine\DBAL\Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Api\Lists\Albums;
use Oligus\GraphqlTalk\Modules\Artist as ArtistEntity;
use Oligus\GraphqlTalk\Modules\Album as AlbumEntity;

class Artist
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        /** @var ArtistEntity $artist */
        $artist = $context->getEm()->getRepository(ArtistEntity::class)->find($args['id']);

        if (empty($artist)) {
            throw new Exception('Artist not found.');
        }

        return self::resolveFields($artist);
    }

    public static function resolveFields(ArtistEntity $artist): array
    {
        return [
            'id' => $artist->id,
            'name' => $artist->name,
            'albums' => function() use ($artist) {
                return !empty($artist->albums)
                    ? Albums::resolveFields($artist->albums, AlbumEntity::class, Album::class)
                    : [];
            },
        ];
    }
}
