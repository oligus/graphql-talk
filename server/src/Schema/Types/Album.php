<?php declare(strict_types=1);

namespace Server\Schema\Types;

use GraphQL\Type\Definition\ObjectType;
use Server\Schema\TypeManager;
use Server\Schema\Fields\Artist;

/**
 * Class Album
 * @package Server\Schema\Types
 */
class Album extends ObjectType
{
    /**
     * Album constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $config = [
            'name' => 'Album',
            'description' => 'Album',
            'fields' => [
                'id' => ['type' => TypeManager::ID()],
                'title' => ['type' => TypeManager::string()]
            ]
        ];

        parent::__construct($config);
    }
}
