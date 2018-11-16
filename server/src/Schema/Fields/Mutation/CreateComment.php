<?php declare(strict_types=1);

namespace Server\Schema\Fields\Mutation;

use Server\Database\Entities\Comment;
use Server\Database\Entities\Post;
use Server\Schema\Fields\Field;
use Server\Database\Entities\Author;
use Server\Database\Manager;
use Server\Schema\TypeManager;
use Server\Schema\AppContext;
use GraphQL\Type\Definition\ResolveInfo;
use Server\Helpers\ClassHelper;

/**
 * Class CreateComment
 * @package Server\Schema\Fields\Mutation
 */
class CreateComment implements Field
{
    /**
     * @return array
     * @throws \Exception
     */
    public static function getField(): array
    {
        return [
            'name' => 'createComment',
            'args' => [
                'commentInput' => [
                    'type' => TypeManager::getInput('CommentInputType'),
                    'name' => 'CommentInputType',
                ]
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
        $values = $args['CommentInputType'];

        $author = Manager::getInstance()->getEm()->getReference(Author::class, $values['authorId']);
        $post = Manager::getInstance()->getEm()->getReference(Post::class, $values['postId']);

        $comment = Comment::create($values['title'], $values['content'], $author, $post);

        Manager::getInstance()->getEm()->persist($comment);
        Manager::getInstance()->getEm()->flush();

        return [
            'id' => ClassHelper::getPropertyValue($comment, 'id'),
            'title' => ClassHelper::getPropertyValue($comment, 'title'),
        ];
    }

    public static function getData(array $args)
    {
        // TODO: Implement getData() method.
    }

}