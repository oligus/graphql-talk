<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Nodes;

use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Modules\InvoiceLine as InvoiceLineEntity;

class InvoiceLine extends Node
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        /** @var InvoiceLineEntity $invoiceLine */
        $invoiceLine = $context->getEm()->getRepository(InvoiceLineEntity::class)->find($args['id']);

        if (empty($invoiceLine)) {
            throw new Exception('Album not found.');
        }

        return self::resolveFields($invoiceLine);
    }


    public static function resolveFields(InvoiceLineEntity $invoiceLine): array
    {
        return [
            'id' => $invoiceLine->id,
            'invoice' => function() use ($invoiceLine) {
                return !empty($invoiceLine->invoice)
                    ? Invoice::resolveFields($invoiceLine->invoice)
                    : null;
            },
            'track' => function() use ($invoiceLine) {
                return !empty($invoiceLine->track)
                    ? Track::resolveFields($invoiceLine->track)
                    : null;
            },
            'quantity' => $invoiceLine->quantity,

        ];
    }
}
