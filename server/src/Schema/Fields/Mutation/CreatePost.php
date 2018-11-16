<?php declare(strict_types=1);

namespace Server\Schema\Fields\Mutation;

use Server\Database\Entities\Post;
use Server\Schema\Fields\Field;
use Server\Database\Entities\Author;
use Server\Database\Manager;
use Server\Schema\TypeManager;
use Server\Schema\AppContext;
use GraphQL\Type\Definition\ResolveInfo;
use Server\Helpers\ClassHelper;

/**
 * Class CreateAuthor
 * @package Server\Schema\Fields\Mutation
 */
class CreatePost implements Field
{
    /**
     * @return array
     * @throws \Exception
     */
    public static function getField(): array
    {
        return [
            'name' => 'createPost',
            'args' => [
                'priceItemInput' => [
                    'type' => TypeManager::getInput('PostInputType'),
                    'name' => 'PostInputType',
                ]
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
        $values = $args['PostInputType'];

        $post = new Post();
        $post->setTitle($values['title']);
        $post->setContent($values['content']);

        $author = Manager::getInstance()->getEm()->getReference(Author::class, $values['authorId']);
        $post->setAuthor($author);

        $post->setDate(new \DateTime());

        Manager::getInstance()->getEm()->persist($post);
        Manager::getInstance()->getEm()->flush();

        return [
            'id' => ClassHelper::getPropertyValue($post, 'id'),
            'title' => ClassHelper::getPropertyValue($post, 'title'),
        ];
    }

    public static function getData(array $args)
    {
        // TODO: Implement getData() method.
    }

}