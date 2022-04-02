<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Mutations;

use Doctrine\DBAL\Exception;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Api\Nodes\Artist;
use Oligus\GraphqlTalk\Modules\Artist as ArtistEntity;

class UpdateArtist
{
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        /** @var ArtistEntity $artist */
        $artist = $context->getEm()->getRepository(ArtistEntity::class)->find($args['id']);

        if (!$artist) {
            throw new Exception('Artist not found.');
        }

        $artist->setName($args['name']);
        $context->getEm()->flush();

        return Artist::resolveFields($artist);
    }
}
