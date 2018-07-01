<?php declare(strict_types=1);

namespace Server\Schema\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Class MediaType
 * @package Server\Schema\Types
 *
 */
class MediaType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'MediaType',
            'description' => 'MediaType',
            'fields' => [
                'id' => ['type' => Type::ID()],
                'name' => ['type' => Type::string()]
            ]
        ];

        parent::__construct($config);
    }
}
