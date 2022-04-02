<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Nodes;

use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Modules\Customer as CustomerEntity;

class Customer extends Node
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        /** @var CustomerEntity $customer */
        $customer = $context->getEm()->getRepository(CustomerEntity::class)->find($args['id']);

        if (!$customer) {
            throw new Exception('Artist not found.');
        }

        return self::resolveFields($customer);
    }

    public static function resolveFields(CustomerEntity $customer): array
    {
        return [
            'id' => $customer->id,
            'lastName' => $customer->lastName,
            'firstName' => $customer->firstName,
            'company' => $customer->company,
            'address' => $customer->address,
            'city' => $customer->city,
            'state' => $customer->state,
            'country' => $customer->country,
            'postalCode' => $customer->postalCode,
            'phone' => $customer->phone,
            'fax' => $customer->fax,
            'email' => $customer->email,
            'supportRep' => function() use ($customer) {
                return !empty($customer->supportRep)
                    ? Employee::resolveFields($customer->supportRep)
                    : null;
            }
        ];
    }
}
