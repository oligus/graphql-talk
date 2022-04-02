<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Nodes;

use Doctrine\DBAL\Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Modules\Employee as EmployeeEntity;

class Employee extends Node
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        /** @var EmployeeEntity $employee */
        $employee = $context->getEm()->getRepository(EmployeeEntity::class)->find($args['id']);

        if (empty($employee)) {
            throw new Exception('Employee not found.');
        }

        return self::resolveFields($employee);
    }

    public static function resolveFields(EmployeeEntity $employee): array
    {
        return [
            'id' => $employee->id,
            'lastName' => $employee->lastName,
            'firstName' => $employee->firstName,
            'title' => $employee->title,
            'reportsTo' => function() use ($employee) {
                return !empty($employee->reportsTo)
                    ? Employee::resolveFields($employee->reportsTo)
                    : null;
            },
            'birthDate' => $employee->birthDate,
            'hireDate' => $employee->hireDate,
            'address' => $employee->address,
            'city' => $employee->city,
            'state' => $employee->state,
            'country' => $employee->country,
            'postalCode' => $employee->postalCode,
            'phone' => $employee->phone,
            'fax' => $employee->fax,
            'email' => $employee->email,
        ];
    }
}
