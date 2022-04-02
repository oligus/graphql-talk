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
            'id' => $customer->getId(),
            'lastName' => $customer->getLastName(),
            'firstName' => $customer->getFirstName(),
            'company' => $customer->getCompany(),
            'address' => $customer->getAddress(),
            'city' => $customer->getCity(),
            'state' => $customer->getState(),
            'country' => $customer->getCountry(),
            'postalCode' => $customer->getPostalCode(),
            'phone' => $customer->getPhone(),
            'fax' => $customer->getFax(),
            'email' => $customer->getEmail(),
            // 'supportRep' => $customer->getSupportRep(),
        ];
    }
}
