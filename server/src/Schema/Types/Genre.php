<?php declare(strict_types=1);

namespace Server\Schema\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Class Genre
 * @package Server\Schema\Types
 */
class Genre extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Genre',
            'description' => 'Genre',
            'fields' => [
                'id' => ['type' => Type::ID()],
                'name' => ['type' => Type::string()]
            ]
        ];

        parent::__construct($config);
    }
}
