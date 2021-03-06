<?php declare(strict_types=1);

namespace Server\Schema\Types;

use Server\Schema\TypeManager;
use GraphQL\Type\Definition\ObjectType;

/**
 * Class Posts
 * @package Server\Schema\Types
 */
class Posts extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Posts',
            'description' => 'A list of blog posts',
            'fields' => [
                'total' => [
                    'type' => TypeManager::int(),
                    'description' => 'Total number of records',
                ],
                'count' => [
                    'type' => TypeManager::int(),
                    'description' => 'Number of records in selection',
                ],
                'nodes' => [
                    'type' =>  TypeManager::listOf(TypeManager::get('post')),
                    'description' => 'Albums',
                ]
            ]
        ];

        parent::__construct($config);
    }
}
