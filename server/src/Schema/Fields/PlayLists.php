<?php declare(strict_types=1);

namespace Server\Schema\Fields;

use Server\Database\Entities\Playlists as PlaylistsEntity;
use Server\Schema\TypeManager;
use Server\Schema\AppContext;
use Server\Database\Manager;
use Server\Helpers\ClassHelper;
use Server\Schema\Query\Filter;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Class Albums
 * @package Server\Schema\Fields
 */
class PlayLists implements Field
{
    /**
     * @return array
     * @throws \Exception
     */
    public static function getField(): array
    {
        $filter = Filter::create('PlaylistsFilter');
        $filter->addField('id', ['type' => TypeManager::id()]);
        $filter->addField('name', ['type' => TypeManager::string()]);

        Manager::getInstance()->getFilterCollection()->add($filter);

        return [
            'type' => TypeManager::get('playLists'),
            'args' => [
                'filter' => Manager::getInstance()->getFilterCollection()->get('PlaylistsFilter'),
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
        if ($value instanceof PlaylistsEntity) {
            $playLists = [$value];
        } else {
            $playLists = self::getData($args);
        }

        $nodes = [];

        /** @var PlaylistsEntity $playList */
        foreach ($playLists as $playList) {
            $nodes[] = [
                'id' => ClassHelper::getPropertyValue($playList, 'id'),
                'name' => ClassHelper::getPropertyValue($playList, 'name'),
            ];
        }

        return [
            'count' => self::getCount(),
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
        $repo = $em->getRepository(PlaylistsEntity::class);

        return $repo->getCount();
    }

    /**
     * @param array $args
     * @return mixed
     */
    public static function getData(array $args)
    {
        /** @var \Server\Database\Repositories\CommonRepository $repo */
        $repo = Manager::getInstance()->getEm()->getRepository(PlaylistsEntity::class);
        return $repo->filter($args);
    }
}
