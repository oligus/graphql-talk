<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Mutations;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Api\Nodes\Artist;
use Oligus\GraphqlTalk\Modules\Artist as ArtistEntity;

class CreateArtist
{
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $artist = new ArtistEntity();
        $artist->name = $args['name'];

        $context->getEm()->persist($artist);
        $context->getEm()->flush();

        return Artist::resolveFields($artist);
    }
}
