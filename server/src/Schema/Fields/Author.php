<?php declare(strict_types=1);

namespace Server\Schema\Fields;

use Server\Database\Entities\Author as AuthorEntity;
use Server\Schema\TypeManager;
use Server\Schema\AppContext;
use Server\Database\Manager;
use Server\Helpers\ClassHelper;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Class Author
 * @package Server\Schema\Fields
 */
class Author implements Field
{
    /**
     * @return array
     * @throws \Exception
     */
    public static function getField(): array
    {
        return [
            'type' => TypeManager::get('author'),
            'description' => 'Author of a post, comment or even both.',
            'args' => ['id' => TypeManager::id()],
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
        if(!empty($value) && array_key_exists('author', $value)) {
            $author = $value['author'];
        } elseif ($value instanceof AuthorEntity) {
            $author = $value;
        } else {
            $author = self::getData($args);
        }

        if(!$author instanceof AuthorEntity) {
            return null;
        }

        return [
            'id' => ClassHelper::getPropertyValue($author, 'id'),
            'name' => ClassHelper::getPropertyValue($author, 'name'),
            'posts' => ClassHelper::getPropertyValue($author, 'posts'),
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

        return $em->getRepository(AuthorEntity::class)->find($id);
    }
}
