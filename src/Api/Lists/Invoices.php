<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Lists;

use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Api\Nodes\Invoice;
use Oligus\GraphqlTalk\Modules\Invoice as InvoiceEntity;

class Invoices extends AbstractListResolver
{
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $qb = $context->getEm()->getRepository(InvoiceEntity::class)->createQueryBuilder('t');
        $qb->setMaxResults($args['first'] ?? null);
        $qb->setFirstResult($args['after'] ?? 0);

        return self::resolveFields($qb->getQuery()->getResult(), InvoiceEntity::class, Invoice::class);
    }
}
