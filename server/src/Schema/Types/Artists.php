<?php declare(strict_types=1);

namespace Server\Schema\Types;

use Server\Schema\TypeManager;
use GraphQL\Type\Definition\ObjectType;

/**
 * Class Albums
 * @package Server\Schema\Types
 */
class Artists extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Artists',
            'description' => 'Artists',
            'fields' => [
                'total' => [
                    'type' => TypeManager::int(),
                    'description' => 'Total number of records',
                ],
                'nodes' => [
                    'type' =>  TypeManager::listOf(TypeManager::get('artist')),
                    'description' => 'Albums',
                ]
            ]
        ];

        parent::__construct($config);
    }
}
