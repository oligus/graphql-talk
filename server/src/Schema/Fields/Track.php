<?php declare(strict_types=1);

namespace Server\Schema\Fields;

use Server\Database\Entities\Tracks;
use Server\Schema\TypeManager;
use Server\Schema\AppContext;
use Server\Database\Manager;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Class MusicUsageArea
 * @package CM\Schema\Fields
 */
class Track implements Field
{
    /**
     * @return array
     * @throws \Exception
     */
    public static function getField(): array
    {
        return [
            'type' => TypeManager::track(),
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
     */
    public static function resolve($value, $args, AppContext $appContext, ResolveInfo $resolveInfo)
    {
        if(!empty($value) && array_key_exists('track', $value)) {
            $track = $value['track'];
        } else {
            $track = self::getData($args);
        }

        if(!$track instanceof Tracks) {
            return null;
        }

        return [
            'id' => $track->getId(),
            'name' => $track->getName(),
            'composer' => $track->getComposer(),
            'milliseconds' => $track->getMilliseconds(),
            'price' => $track->getPrice()
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

        return $em->getRepository(Tracks::class)->find($id);
    }
}
