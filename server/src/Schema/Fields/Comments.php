<?php declare(strict_types=1);

namespace Server\Schema\Fields;

use Server\Database\Entities\Comment;
use Server\Schema\TypeManager;
use Server\Schema\AppContext;
use Server\Database\Manager;
use Server\Helpers\ClassHelper;
use Server\Schema\Query\Filter;
use Server\Schema\Query\FilterDoctrineCollection;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Class Comments
 * @package Server\Schema\Fields
 */
class Comments implements Field
{
    /**
     * @return array
     * @throws \Exception
     */
    public static function getField(): array
    {
        $filter = Filter::create('CommentFilter');
        $filter->addField('id', ['type' => TypeManager::id()]);
        $filter->addField('name', ['type' => TypeManager::string()]);

        Manager::getInstance()->getFilterCollection()->add($filter);

        return [
            'type' => TypeManager::get('comments'),
            'args' => [
                'filter' => Manager::getInstance()->getFilterCollection()->get('CommentFilter'),
                'first' => [
                    'type' => TypeManager::int()
                ],
                'after' => [
                    'type' => TypeManager::int(),
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
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \ReflectionException
     */
    public static function resolve($value, $args, AppContext $appContext, ResolveInfo $resolveInfo)
    {
        if(!empty($value) && array_key_exists('comments', $value)) {
            $filter = new FilterDoctrineCollection($value['comments'], $args);
            $comments = $filter->getResult();

        } else {
            $comments = self::getData($args);
        }

        $nodes = [];

        foreach ($comments as $comment) {
            $nodes[] = [
                'id' => ClassHelper::getPropertyValue($comment, 'id'),
                'title' => ClassHelper::getPropertyValue($comment, 'title'),
                'content' => ClassHelper::getPropertyValue($comment, 'content'),
                'date' => ClassHelper::getPropertyValue($comment, 'date')->format('Y-m-d'),
                'author' => ClassHelper::getPropertyValue($comment, 'author')
            ];
        }

        return [
            'total' => self::getCount(),
            'count' => count($comments),
            'nodes' => $nodes
        ];
    }

    /**
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public static function getCount()
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = Manager::getInstance()->getEm();

        /** @var \Server\Database\Repositories\CommonRepository $repo*/
        $repo = $em->getRepository(Comment::class);

        return $repo->getCount();
    }

    /**
     * @param array $args
     * @return mixed
     */
    public static function getData(array $args)
    {
        /** @var \Server\Database\Repositories\CommonRepository $repo */
        $repo = Manager::getInstance()->getEm()->getRepository(Comment::class);
        return $repo->filter($args);
    }
}
