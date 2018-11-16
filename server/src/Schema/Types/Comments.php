<?php declare(strict_types=1);

namespace Server\Schema\Types;

use Server\Schema\TypeManager;
use GraphQL\Type\Definition\ObjectType;

/**
 * Class Posts
 * @package Server\Schema\Types
 */
class Comments extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Comments',
            'description' => 'Comments',
            'fields' => [
                'total' => [
                    'type' => TypeManager::int(),
                    'description' => 'Total number of records',
                ],
                'nodes' => [
                    'type' =>  TypeManager::listOf(TypeManager::get('comment')),
                    'description' => 'Comments',
                ]
            ]
        ];

        parent::__construct($config);
    }
}
