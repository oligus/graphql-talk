<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Lists;

use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Api\Nodes\MediaType;
use Oligus\GraphqlTalk\Modules\MediaType as MediaTypeEntity;

class MediaTypes extends AbstractListResolver
{
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $qb = $context->getEm()->getRepository(MediaTypeEntity::class)->createQueryBuilder('t');
        $qb->setMaxResults($args['first'] ?? null);
        $qb->setFirstResult($args['after'] ?? 0);

        return self::resolveFields($qb->getQuery()->getResult(), MediaTypeEntity::class, MediaType::class);
    }
}
