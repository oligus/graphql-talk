<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Lists\Albums;

class RootResolver
{
    public static function resolve(): array
    {
        return [
            'album' => self::getResolver( Nodes\Album::class),
            'albums' => self::getResolver(Lists\Albums::class),
            'artist' => self::getResolver(Nodes\Artist::class),
            'artists' => self::getResolver(Lists\Artists::class),
            'genre' => self::getResolver(Nodes\Genre::class),
            'genres' => self::getResolver(Lists\Genres::class),
            'mediaType' => self::getResolver(Nodes\MediaType::class),
            'mediaTypes' => self::getResolver(Lists\MediaTypes::class),
            'track' => self::getResolver(Nodes\Track::class),
            'tracks' => self::getResolver(Lists\Tracks::class),
            'playList' => self::getResolver(Nodes\PlayList::class),
            'playLists' => self::getResolver(Lists\PlayLists::class),

            'createArtist' => self::getResolver(Mutations\CreateArtist::class),
            'updateArtist' => self::getResolver(Mutations\UpdateArtist::class),
            'removeArtist' => self::getResolver(Mutations\RemoveArtist::class),
            'createGenre' => self::getResolver(Mutations\CreateGenre::class),
            'updateGenre' => self::getResolver(Mutations\UpdateGenre::class),
            'removeGenre' => self::getResolver(Mutations\RemoveGenre::class),
        ];
    }

    private static function getResolver(string $className): Closure
    {
        return function (array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo) use ($className): array {
            return call_user_func_array([$className, 'resolve'], [$rootValue, $args, $context, $resolveInfo]);
        };
    }
}
