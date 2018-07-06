<?php declare(strict_types=1);

namespace Server\Schema\Types;

use Server\Schema\TypeManager;
use GraphQL\Type\Definition\ObjectType;

/**
 * Class Albums
 * @package Server\Schema\Types
 */
class PlayLists extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'PlayLists',
            'description' => 'PlayLists',
            'fields' => [
                'total' => [
                    'type' => TypeManager::int(),
                    'description' => 'Total number of records',
                ],
                'nodes' => [
                    'type' =>  TypeManager::listOf(TypeManager::get('playList')),
                    'description' => 'PlayLists',
                ]
            ]
        ];

        parent::__construct($config);
    }
}
