<?php declare(strict_types=1);

namespace Server\Schema\Types;

use GraphQL\Type\Definition\ObjectType;
use Server\Schema\TypeManager;
use Server\Schema\Fields\Albums;

/**
 * Class Artist
 * @package Server\Schema\Types
 */
class Artist extends ObjectType
{
    /**
     * Artist constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $config = [
            'name' => 'Artist',
            'description' => 'Artist',
            'fields' => [
                'id' => ['type' => TypeManager::ID()],
                'name' => ['type' => TypeManager::string()],
                'albums' => Albums::getField()
            ]
        ];

        parent::__construct($config);
    }
}
