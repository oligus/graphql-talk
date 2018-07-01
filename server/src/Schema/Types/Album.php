<?php declare(strict_types=1);

namespace Server\Schema\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Class Album
 * @package Server\Schema\Types
 */
class Album extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Album',
            'description' => 'Album',
            'fields' => [
                'id' => ['type' => Type::ID()],
                'title' => ['type' => Type::string()]
            ]
        ];

        parent::__construct($config);
    }
}
