<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Lists;

use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Api\Nodes\InvoiceLine;
use Oligus\GraphqlTalk\Modules\InvoiceLine as InvoiceLineEntity;

class InvoiceLines extends AbstractListResolver
{
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $qb = $context->getEm()->getRepository(InvoiceLineEntity::class)->createQueryBuilder('t');
        $qb->setMaxResults($args['first'] ?? null);
        $qb->setFirstResult($args['after'] ?? 0);

        return self::resolveFields($qb->getQuery()->getResult(), InvoiceLineEntity::class, InvoiceLine::class);
    }
}
