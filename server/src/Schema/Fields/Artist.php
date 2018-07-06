<?php declare(strict_types=1);

namespace Server\Schema\Fields;

use Server\Database\Entities\Artists;
use Server\Schema\TypeManager;
use Server\Schema\AppContext;
use Server\Database\Manager;
use Server\Helpers\ClassHelper;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Class Artist
 * @package Server\Schema\Fields
 */
class Artist implements Field
{
    /**
     * @return array
     * @throws \Exception
     */
    public static function getField(): array
    {
        return [
            'type' => TypeManager::get('artist'),
            'args' => [
                'id' => [
                    'type' => TypeManager::ID(),
                    'defaultValue' => 0
                ],
            ],
            'resolve' => function ($value, $args, AppContext $appContext, ResolveInfo $resolveInfo) {
                return self::resolve($value, $args, $appContext,  $resolveInfo);
            }
        ];
    }

    /**
     * @param $value
     * @param array $args
     * @param AppContext $appContext
     * @param ResolveInfo $resolveInfo
     * @return array|mixed|null
     * @throws \ReflectionException
     */
    public static function resolve($value, $args, AppContext $appContext, ResolveInfo $resolveInfo)
    {
        if(!empty($value) && array_key_exists('artist', $value)) {
            $artist = $value['artist'];
        } else {
            $artist = self::getData($args);
        }

        if(!$artist instanceof Artists) {
            return null;
        }

        return [
            'id' => ClassHelper::getPropertyValue($artist, 'id'),
            'name' => ClassHelper::getPropertyValue($artist, 'name'),
            'albums' => ClassHelper::getPropertyValue($artist, 'albums')
        ];
    }

    /**
     * @param array $args
     * @return mixed|null|object
     */
    public static function getData(array $args)
    {
        $id = array_key_exists('id', $args) ? $args['id'] : 0;

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = Manager::getInstance()->getEm();

        return $em->getRepository(Artists::class)->find($id);
    }
}
