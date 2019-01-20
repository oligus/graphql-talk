<?php declare(strict_types=1);

namespace Server\Schema\Fields\Mutation;

use Server\Schema\Fields\Field;
use Server\Database\Entities\Author;
use Server\Database\Manager;
use Server\Schema\TypeManager;
use Server\Schema\AppContext;
use GraphQL\Type\Definition\ResolveInfo;
use Server\Helpers\ClassHelper;

/**
 * Class DeleteAuthor
 * @package Server\Schema\Fields\Mutation
 */
class DeleteAuthor
{
    /**
     * @return array
     * @throws \Exception
     */
    public static function getField(): array
    {
        return [
            'name' => 'deleteAuthor',
            'args' => [
                'id' => TypeManager::nonNull(TypeManager::id())
            ],
            'type' => TypeManager::get('author'),
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
        $author = Manager::getInstance()
            ->getEm()
            ->getRepository('Server\Database\Entities\Author')
            ->find( (int) $args['id']);

        $authorCopy = clone $author;

        Manager::getInstance()->getEm()->remove($author);
        Manager::getInstance()->getEm()->flush();

        return [
            'id' => ClassHelper::getPropertyValue($authorCopy, 'id'),
            'name' => ClassHelper::getPropertyValue($authorCopy, 'name'),
            'posts' => ClassHelper::getPropertyValue($authorCopy, 'posts'),
        ];
    }
}