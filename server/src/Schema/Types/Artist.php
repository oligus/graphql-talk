<?php declare(strict_types=1);

namespace Server\Schema\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Class Artist
 * @package Server\Schema\Types
 */
class Artist extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Artist',
            'description' => 'Artist',
            'fields' => [
                'id' => ['type' => Type::ID()],
                'name' => ['type' => Type::string()]
            ]
        ];

        parent::__construct($config);
    }
}
