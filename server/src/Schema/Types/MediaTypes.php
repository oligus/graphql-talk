<?php declare(strict_types=1);

namespace Server\Schema\Types;

use Server\Schema\TypeManager;
use GraphQL\Type\Definition\ObjectType;

/**
 * Class MediaTypes
 * @package Server\Schema\Types
 */
class MediaTypes extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'MediaTypes',
            'description' => 'MediaTypes',
            'fields' => [
                'total' => [
                    'type' => TypeManager::int(),
                    'description' => 'Total number of records',
                ],
                'nodes' => [
                    'type' =>  TypeManager::listOf(TypeManager::get('mediaType')),
                    'description' => 'MediaTypes',
                ]
            ]
        ];

        parent::__construct($config);
    }
}
