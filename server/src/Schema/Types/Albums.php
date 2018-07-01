<?php declare(strict_types=1);

namespace Server\Schema\Types;

use Server\Schema\TypeManager;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Class Albums
 * @package Server\Schema\Types
 */
class Albums extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Albums',
            'description' => 'Albums',
            'fields' => [
                'count' => [
                    'type' => TypeManager::int(),
                    'description' => 'Record count',
                ],
                'nodes' => [
                    'type' =>  TypeManager::listOf(TypeManager::get('album')),
                    'description' => 'Albums',
                ]
            ]
        ];

        parent::__construct($config);
    }
}
