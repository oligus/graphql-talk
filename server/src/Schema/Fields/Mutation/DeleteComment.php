<?php declare(strict_types=1);

namespace Server\Schema\Fields\Mutation;

use Server\Schema\Fields\Field;
use Server\Database\Entities\Comment;
use Server\Database\Manager;
use Server\Schema\TypeManager;
use Server\Schema\AppContext;
use GraphQL\Type\Definition\ResolveInfo;
use Server\Helpers\ClassHelper;

/**
 * Class DeleteComment
 * @package Server\Schema\Fields\Mutation
 */
class DeleteComment
{
    /**
     * @return array
     * @throws \Exception
     */
    public static function getField(): array
    {
        return [
            'name' => 'deleteComment',
            'args' => [
                'id' => TypeManager::nonNull(TypeManager::id())
            ],
            'type' => TypeManager::get('comment'),
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

        $comment = Manager::getInstance()
            ->getEm()
            ->getRepository('Server\Database\Entities\Comment')
            ->find($id);

        if(!$comment instanceof Comment) {
            throw new \Exception('Post with id: ' . $id . ' not found.');
        }

        $result = [
            'id' => ClassHelper::getPropertyValue($comment, 'id'),
            'author' => ClassHelper::getPropertyValue($comment, 'author'),
            'title' => ClassHelper::getPropertyValue($comment, 'title'),
            'content' => ClassHelper::getPropertyValue($comment, 'content'),
            'date' => ClassHelper::getPropertyValue($comment, 'date')->format('Y-m-d')
        ];

        Manager::getInstance()->getEm()->remove($comment);
        Manager::getInstance()->getEm()->flush();

        return $result;
    }
}