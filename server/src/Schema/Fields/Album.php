<?php declare(strict_types=1);

namespace Server\Schema\Fields;

use Server\Database\Entities\Albums;
use Server\Schema\TypeManager;
use Server\Schema\AppContext;
use Server\Database\Manager;
use Server\Helpers\ClassHelper;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Class Album
 * @package Server\Schema\Fields
 */
class Album implements Field
{
    /**
     * @return array
     * @throws \Exception
     */
    public static function getField(): array
    {
        return [
            'type' => TypeManager::get('album'),
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
        die('album');
        if(!empty($value) && array_key_exists('album', $value)) {
            $album = $value['album'];
        } else {
            $album = self::getData($args);
        }

        if(!$album instanceof Albums) {
            return null;
        }

        return [
            'id' => ClassHelper::getPropertyValue($album, 'id'),
            'title' => ClassHelper::getPropertyValue($album, 'title'),
            'artist' => ClassHelper::getPropertyValue($album, 'artist')
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

        return $em->getRepository(Albums::class)->find($id);
    }
}
