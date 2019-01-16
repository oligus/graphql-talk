<?php declare(strict_types=1);

namespace Server\Schema\Fields;

use Server\Database\Entities\Post;
use Server\Schema\TypeManager;
use Server\Schema\AppContext;
use Server\Database\Manager;
use Server\Helpers\ClassHelper;
use Server\Schema\Query\Filter;
use Server\Schema\Query\FilterDoctrineCollection;
use GraphQL\Type\Definition\ResolveInfo;
use Doctrine\Common\Collections\Collection;

/**
 * Class Authors
 * @package Server\Schema\Fields
 */
class Posts implements Field
{
    /**
     * @return array
     * @throws \Exception
     */
    public static function getField(): array
    {
        $filter = Filter::create('AuthorFilter');
        $filter->addField('id', ['type' => TypeManager::id()]);
        $filter->addField('name', ['type' => TypeManager::string()]);

        Manager::getInstance()->getFilterCollection()->add($filter);

        return [
            'type' => TypeManager::get('posts'),
            'args' => [
                'filter' => Manager::getInstance()->getFilterCollection()->get('AuthorFilter'),
                'first' => [
                    'type' => TypeManager::int()
                ],
                'offset' => [
                    'type' => TypeManager::int(),
                    'defaultValue' => 0
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
        if(!empty($value) && array_key_exists('posts', $value)) {
            $filter = new FilterDoctrineCollection($value['posts'], $args);
            $posts = $filter->getResult();
        } elseif ($value instanceof Post) {
            $posts = [$value];
        } else {
            $posts = self::getData($args);
        }

        $nodes = [];

        /** @var Post $post */
        foreach ($posts as $post) {
            $nodes[] = [
                'id' => ClassHelper::getPropertyValue($post, 'id'),
                'title' => ClassHelper::getPropertyValue($post, 'title'),
                'content' => ClassHelper::getPropertyValue($post, 'content'),
                'date' => ClassHelper::getPropertyValue($post, 'date')->format('Y-m-d'),
                'comments' => ClassHelper::getPropertyValue($post, 'comments'),
                'author' => ClassHelper::getPropertyValue($post, 'author')
            ];
        }

        return [
            'total' => self::getCount(),
            'count' => count($posts),
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
        $repo = $em->getRepository(Post::class);

        return $repo->getCount();
    }

    /**
     * @param array $args
     * @return mixed
     */
    public static function getData(array $args)
    {
        /** @var \Server\Database\Repositories\CommonRepository $repo */
        $repo = Manager::getInstance()->getEm()->getRepository(Post::class);
        return $repo->filter($args);
    }
}
