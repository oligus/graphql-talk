<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Nodes;

use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Modules\InvoiceLine as InvoiceLineEntity;

class InvoiceLine extends Node
{
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        /** @var InvoiceLineEntity $invoiceLine */
        $invoiceLine = $context->getEm()->getRepository(InvoiceLineEntity::class)->find($args['id']);
        return $invoiceLine->toArray();
    }
}
