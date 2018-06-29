<?php declare(strict_types=1);

namespace Server\Schema\Types;

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
            'fields' => []
        ];
        parent::__construct($config);
    }
}