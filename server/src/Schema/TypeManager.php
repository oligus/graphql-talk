<?php declare(strict_types=1);

namespace Server\Schema;

use Server\Schema\Types\QueryType;
use Server\Schema\Types\Track;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\Type;

/**
 * Class Types
 *
 * Acts as a registry and factory for your types.
 *
 * As simplistic as possible for the sake of clarity of this example.
 * Your own may be more dynamic (or even code-generated).
 *
 * @package GraphQL\Examples\Blog
 */
class TypeManager
{
    private static $query;
    private static $track;

    /**
     * @return QueryType
     * @throws \Exception
     */
    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }

    public static function track()
    {
        return self::$track ?: (self::$track = new Track());
    }

    public static function boolean()
    {
        return Type::boolean();
    }

    /**
     * @return \GraphQL\Type\Definition\FloatType
     */
    public static function float()
    {
        return Type::float();
    }

    /**
     * @return \GraphQL\Type\Definition\IDType
     */
    public static function id()
    {
        return Type::id();
    }

    /**
     * @return \GraphQL\Type\Definition\IntType
     */
    public static function int()
    {
        return Type::int();
    }

    /**
     * @return \GraphQL\Type\Definition\StringType
     */
    public static function string()
    {
        return Type::string();
    }

    /**
     * @param Type $type
     * @return ListOfType
     */
    public static function listOf($type)
    {
        return new ListOfType($type);
    }

    /**
     * @param $type
     * @return NonNull
     * @throws \Exception
     */
    public static function nonNull($type)
    {
        return new NonNull($type);
    }
}
