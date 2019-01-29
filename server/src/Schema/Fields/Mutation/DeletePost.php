<?php declare(strict_types=1);

namespace Server\Schema\Fields\Mutation;

use Server\Schema\Fields\Field;
use Server\Database\Entities\Post;
use Server\Database\Manager;
use Server\Schema\TypeManager;
use Server\Schema\AppContext;
use GraphQL\Type\Definition\ResolveInfo;
use Server\Helpers\ClassHelper;

/**
 * Class DeletePost
 * @package Server\Schema\Fields\Mutation
 */
class DeletePost
{
    /**
     * @return array
     * @throws \Exception
     */
    public static function getField(): array
    {
        return [
            'name' => 'deletePost',
            'args' => [
                'id' => TypeManager::nonNull(TypeManager::id())
            ],
            'type' => TypeManager::get('post'),
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
        $id = (int) $args['id'];

        $post = Manager::getInstance()
            ->getEm()
            ->getRepository('Server\Database\Entities\Post')
            ->find($id);

        if(!$post instanceof Post) {
            throw new \Exception('Post with id: ' . $id . ' not found.');
        }

        $result = [
            'id' => ClassHelper::getPropertyValue($post, 'id'),
            'title' => ClassHelper::getPropertyValue($post, 'title'),
            'content' => ClassHelper::getPropertyValue($post, 'content'),
            'date' => ClassHelper::getPropertyValue($post, 'date')->format('Y-m-d'),
            'author' => ClassHelper::getPropertyValue($post, 'author'),
            'comments' => ClassHelper::getPropertyValue($post, 'comments')
        ];

        Manager::getInstance()->getEm()->remove($post);
        Manager::getInstance()->getEm()->flush();

        return $result;
    }
}