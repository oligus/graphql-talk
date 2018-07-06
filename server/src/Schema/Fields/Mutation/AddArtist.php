<?php declare(strict_types=1);

namespace Server\Schema\Fields\Mutation;

use Server\Schema\Fields\Field;
use Server\Database\Entities\Albums;
use Server\Schema\TypeManager;
use Server\Schema\AppContext;
use Server\Database\Manager;
use Server\Helpers\ClassHelper;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Class CopyPriceList
 * @package CM\Schema\Mutations
 */
class AddArtist implements Field
{
    /**
     * @return array
     * @throws \Exception
     */
    public static function getField(): array
    {
        
        return [
            'name' => 'createOption',
            'args' => [
                'name' => TypeManager::nonNull(TypeManager::string()),
                'value' => TypeManager::nonNull(TypeManager::boolean())
            ],
            'type' => TypeManager::get('artist'),
            'resolve' => function ($value, array $args, AppContext $appContext, ResolveInfo $resolveInfo) {
                return self::resolve($value, $args, $appContext, $resolveInfo);
            }
        ];
    }

    /**
     * @param $value
     * @param array $args
     * @param AppContext $appContext
     * @param ResolveInfo $resolveInfo
     * @return mixed
     * @throws \Exception
     */
    public static function resolve($value, array $args, AppContext $appContext, ResolveInfo $resolveInfo)
    {
        echo "resolve";
        die;
    }

    /**
     * @param array $args
     * @return OptionEntity
     * @throws \Exception
     */
    public static function getData(array $args)
    {
        die('get data');
    }

}