<?php declare(strict_types=1);

namespace Server\Schema\Fields;

use Server\Database\Entities\Post as PostEntity;
use Server\Schema\TypeManager;
use Server\Schema\AppContext;
use Server\Database\Manager;
use Server\Helpers\ClassHelper;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Class Post
 * @package Server\Schema\Fields
 */
class Post implements Field
{
    /**
     * @return array
     * @throws \Exception
     */
    public static function getField(): array
    {
        return [
            'type' => TypeManager::get('post'),
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
        if(!empty($value) && array_key_exists('post', $value)) {
            $post = $value['post'];
        } elseif ($value instanceof PostEntity) {
            $post = $value;
        } else {
            $post = self::getData($args);
        }

        if(!$post instanceof PostEntity) {
            return null;
        }

        return [
            'id' => ClassHelper::getPropertyValue($post, 'id'),
            'title' => ClassHelper::getPropertyValue($post, 'title'),
            'content' => ClassHelper::getPropertyValue($post, 'content'),
            'date' => ClassHelper::getPropertyValue($post, 'date')->format('Y-m-d'),
            'author' => ClassHelper::getPropertyValue($post, 'author'),
            'comments' => ClassHelper::getPropertyValue($post, 'comments')
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

        return $em->getRepository(PostEntity::class)->find($id);
    }
}
