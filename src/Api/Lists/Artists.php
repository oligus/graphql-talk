<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Lists;

use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Api\Nodes\Artist;
use Oligus\GraphqlTalk\Modules\Artist as ArtistEntity;

class Artists extends AbstractListResolver
{
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $qb = $context->getEm()->getRepository(ArtistEntity::class)->createQueryBuilder('t');
        $qb->setMaxResults($args['first'] ?? null);
        $qb->setFirstResult($args['after'] ?? 0);

        return self::resolveFields($qb->getQuery()->getResult(), ArtistEntity::class, Artist::class);
    }
}