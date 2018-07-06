<?php declare(strict_types=1);

namespace Server\Schema\Types;

use Server\Schema\Fields\Album;
use Server\Schema\Fields\Genre;
use Server\Schema\Fields\MediaType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Class LabelType
 * @package CM\Schema\Type
 */
class Track extends ObjectType
{
    /**
     * Track constructor.
     * @throws \Exception
     */
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
                'price'         => ['type' => Type::float()],
                'album'         => Album::getField(),
                'genre'         => Genre::getField(),
                'mediaType'     => MediaType::getField()
            ]
        ];

        parent::__construct($config);
    }
}
