<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\GraphQL\Custom;

use Closure;
use GraphQL\Error\Error;
use Stimplify\Api\Common\Scalars\DateTimeType;
use Stimplify\Api\Common\Scalars\DateType;
use Stimplify\Api\Common\Scalars\Int64;
use Stimplify\Api\Common\Scalars\MoneyType;
use Stimplify\Api\Common\Scalars\UploadType;
use Stimplify\Api\Common\Scalars\UuidType;

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

            /* enum types WIP
            if ($typeConfig['astNode'] instanceof EnumTypeDefinitionNode) {
                $typeConfig['values'] = EnumValueMapper::map($typeConfig);
                $typeConfig = array_merge($typeConfig, [
                    'serialize' => function() {
                        die('serialize');
                    }
                ]);

                return $typeConfig;
            }
            */


            switch ($typeConfig['name']) {
                case 'UUID':
                    $typeConfig = array_merge($typeConfig, UuidType::config());
                    break;

                case 'Date':
                    $typeConfig = array_merge($typeConfig, DateType::config());
                    break;

                case 'DateTime':
                    $typeConfig = array_merge($typeConfig, DateTimeType::config());
                    break;

                case 'Money':
                    $typeConfig = array_merge($typeConfig, MoneyType::config());
                    break;

                case 'Upload':
                    $typeConfig = array_merge($typeConfig, UploadType::config());
                    break;

                case 'Int64':
                    $typeConfig = array_merge($typeConfig, Int64::config());
                    break;
            }

            return $typeConfig;
        };
    }
}
