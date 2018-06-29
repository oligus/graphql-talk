<?php declare(strict_types=1);

namespace Server\Schema\Types;

use Server\Schema\Fields\Track;
use GraphQL\Type\Definition\ObjectType;

/**
 * Class QueryType
 * @package CM\Schema\Type
 */
class QueryType extends ObjectType
{
    /**
     * QueryType constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $config = [
            'name' => 'Query',
            'fields' => [
                'track' => Track::getField(),
            ]
        ];

        parent::__construct($config);

    }
}
