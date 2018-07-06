<?php declare(strict_types=1);

namespace Server\Schema\Types;

use GraphQL\Type\Definition\ObjectType;
use Server\Schema\TypeManager;

/**
 * Class Album
 * @package Server\Schema\Types
 */
class PlayList extends ObjectType
{
    /**
     * Album constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $config = [
            'name' => 'PlayList',
            'description' => 'Play list',
            'fields' => [
                'id' => ['type' => TypeManager::ID()],
                'name' => ['type' => TypeManager::string()]
            ]
        ];

        parent::__construct($config);
    }
}
