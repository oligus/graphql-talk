<?php declare(strict_types=1);

namespace Server\Schema\Types;

use GraphQL\Type\Definition\ObjectType;
use Server\Schema\Fields\Mutation\CreateAuthor;
use Server\Schema\Fields\Mutation\CreateComment;
use Server\Schema\Fields\Mutation\CreatePost;
use Server\Schema\Fields\Mutation\DeleteAuthor;
use Server\Schema\Fields\Mutation\DeleteComment;
use Server\Schema\Fields\Mutation\DeletePost;
use Server\Schema\Fields\Mutation\UpdateAuthor;
use Server\Schema\Fields\Mutation\UpdateComment;
use Server\Schema\Fields\Mutation\UpdatePost;

/**
 * Class QueryType
 * @package CM\Schema\Type
 */
class MutationType extends ObjectType
{
    /**
     * MutationType constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $config = [
            'name' => 'Mutation',
            'description' => 'Mutate blog data',
            'fields' => function() {
                return [
                    'createAuthor'  => CreateAuthor::getField(),
                    'updateAuthor'  => UpdateAuthor::getField(),
                    'deleteAuthor'  => DeleteAuthor::getField(),

                    'createPost'    => CreatePost::getField(),
                    'updatePost'    => UpdatePost::getField(),
                    'deletePost'    => DeletePost::getField(),

                    'createComment' => CreateComment::getField(),
                    'updateComment' => UpdateComment::getField(),
                    'deleteComment'  => DeleteComment::getField(),
                ];
            }
        ];

        parent::__construct($config);
    }
}