<?php declare(strict_types=1);

namespace Server\Schema\Types;

use Server\Schema\Fields\Mutation\AddArtist;
use GraphQL\Type\Definition\ObjectType;
use Server\Schema\Fields\Mutation\CreateAuthor;
use Server\Schema\Fields\Mutation\CreateComment;
use Server\Schema\Fields\Mutation\CreatePost;
use Server\Schema\Fields\Mutation\DeleteAuthor;
use Server\Schema\Fields\Mutation\UpdateAuthor;

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
            'fields' => function() {
                return [
                    'createAuthor' => CreateAuthor::getField(),
                    'updateAuthor' => UpdateAuthor::getField(),
                    'deleteAuthor' => DeleteAuthor::getField(),

                    'createPost' => CreatePost::getField(),
                    'createComment' => CreateComment::getField(),
                ];
            }
        ];

        parent::__construct($config);
    }
}