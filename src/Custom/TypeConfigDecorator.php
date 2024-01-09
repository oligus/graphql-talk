<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Custom;

use Closure;
use GraphQL\Error\Error;
use Oligus\GraphqlTalk\Custom\Scalars\DateType;

/**
 * Class TypeConfigDecorator
 * @package Stimplify\Api\Common
 */
class TypeConfigDecorator
{
    public static function resolve(): Closure
    {
        /**
         * @param array<mixed> $typeConfig
         * @return array<mixed>
         * @throws Error
         */
        return function (array $typeConfig) : array {
            switch ($typeConfig['name']) {
                case 'Date':
                    $typeConfig = array_merge($typeConfig, DateType::config());
                    break;
            }

            return $typeConfig;
        };
    }
}
