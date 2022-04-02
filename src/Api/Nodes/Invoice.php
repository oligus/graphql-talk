<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Nodes;

use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Modules\Invoice as InvoiceEntity;

class Invoice extends Node
{
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        /** @var InvoiceEntity $invoice */
        $invoice = $context->getEm()->getRepository(InvoiceEntity::class)->find($args['id']);
        return $invoice->toArray();
    }
}
