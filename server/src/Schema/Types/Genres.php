<?php declare(strict_types=1);

namespace Server\Schema\Types;

use Server\Schema\TypeManager;
use GraphQL\Type\Definition\ObjectType;

/**
 * Class Albums
 * @package Server\Schema\Types
 */
class Genres extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Genres',
            'description' => 'Genres',
            'fields' => [
                'total' => [
                    'type' => TypeManager::int(),
                    'description' => 'Total number of records',
                ],
                'nodes' => [
                    'type' =>  TypeManager::listOf(TypeManager::get('genre')),
                    'description' => 'Genres',
                ]
            ]
        ];

        parent::__construct($config);
    }
}
