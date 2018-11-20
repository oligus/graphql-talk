<?php declare(strict_types=1);

namespace Server\Schema\Types;

use Server\Schema\TypeManager;
use GraphQL\Type\Definition\ObjectType;

/**
 * Class Authors
 * @package Server\Schema\Types
 */
class Authors extends ObjectType
{
    /**
     * Authors constructor.
     */
    public function __construct()
    {
        $config = [
            'name' => 'Authors',
            'description' => 'A list of authors',
            'fields' => [
                'total' => [
                    'type' => TypeManager::int(),
                    'description' => 'Total number of records',
                ],
                'nodes' => [
                    'type' =>  TypeManager::listOf(TypeManager::get('author')),
                    'description' => 'Authors',
                ]
            ]
        ];

        parent::__construct($config);
    }
}
