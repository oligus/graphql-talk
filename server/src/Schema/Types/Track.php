<?php declare(strict_types=1);

namespace Server\Schema\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Class LabelType
 * @package CM\Schema\Type
 */
class Track extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Track',
            'description' => 'Track',
            'fields' => [
                'id'            => ['type' => Type::ID()],
                'name'          => ['type' => Type::string()],
                'composer'      => ['type' => Type::string()],
                'milliseconds'  => ['type' => Type::string()],
                'price'         => ['type' => Type::float()]
                //'albums'  => ['type' => Type::string()], // album
                //'mediaTypes'  => ['type' => Type::string()], // $mediaType
                //'genres'  => ['type' => Type::string()], // genre

            ]
        ];

        parent::__construct($config);
    }
}
