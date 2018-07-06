<?php declare(strict_types=1);

namespace Server\Schema\Types;

use Server\Schema\Fields\Mutation\AddArtist;
use GraphQL\Type\Definition\ObjectType;

/**
 * Class QueryType
 * @package CM\Schema\Type
 */
class MutationType extends ObjectType
{
    /**
     * MutationType constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $config = [
            'name' => 'Mutation',
            'fields' => [
                'addArtist' => AddArtist::getField()
            ]
        ];

        parent::__construct($config);
    }
}