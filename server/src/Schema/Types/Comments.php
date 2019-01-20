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
    /**
     * Comments constructor.
     */
    public function __construct()
    {
        $config = [
            'name' => 'Comments',
            'description' => 'A list of blog post comments',
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
                    'type' =>  TypeManager::listOf(TypeManager::get('comment')),
                    'description' => 'Comments',
                ]
            ]
        ];

        parent::__construct($config);
    }
}
