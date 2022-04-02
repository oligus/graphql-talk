<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Custom\Scalars;

use Exception;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ScalarType;

trait ScalarConfigTrait
{
    /**
     * @throws Error
     */
    public static function config(): array
    {
        $class = self::class;

        /**
         * TODO: Initiate parent class in a better way?
         * @var ScalarType $scalar
         */
        $scalar = new $class;

        if (!$scalar instanceof ScalarType) {
            throw new Error('Not instance of ScalarType');
        }

        return [
            /**
             * @param mixed $value
             * @throws Error
             */
            'serialize' => function ($value) use ($scalar): string {
                return $scalar->serialize($value);
            },
            /**
             * @param mixed $value
             * @return mixed
             * @throws Error
             */
            'parseValue' => function ($value) use ($scalar) {
                return $scalar->parseValue($value);
            },
            /**
             * @param mixed $node
             * @return mixed
             * @throws Exception
             */
            'parseLiteral' => function ($node) use ($scalar) {
                return $scalar->parseLiteral($node);
            }
        ];
    }
}
