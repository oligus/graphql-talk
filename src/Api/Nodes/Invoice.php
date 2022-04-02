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

        return self::resolveFields($invoice);
    }

    public static function resolveFields(InvoiceEntity $invoice): array
    {
        return [
            'id' => $invoice->id,
            'customer' => function() use ($invoice) {
                return !empty($invoice->customer)
                    ? Customer::resolveFields($invoice->customer)
                    : null;
            },
            'invoiceDate' => $invoice->invoiceDate,
            'billingAddress' => $invoice->billingAddress,
            'billingCity' => $invoice->billingCity,
            'billingState' => $invoice->billingState,
            'billingCountry' => $invoice->billingCountry,
            'billingPostalCode' => $invoice->billingPostalCode,
            'total' => $invoice->total,
            // 'invoiceLines' => $invoice->invoiceLines,
        ];
    }
}
