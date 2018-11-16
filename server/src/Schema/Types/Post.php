<?php declare(strict_types=1);

namespace Server\Schema\Types;

use GraphQL\Type\Definition\ObjectType;
use Server\Schema\TypeManager;

/**
 * Class Post
 * @package Server\Schema\Types
 */
class Post extends ObjectType
{
    /**
     * Artist constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $config = [
            'name' => 'Post',
            'description' => 'A blog post',
            'fields' => function() {
                return [
                    'id' => ['type' => TypeManager::ID()],
                    'title' => ['type' => TypeManager::string()],
                    'content' => ['type' => TypeManager::string()],
                ];
            }
        ];

        parent::__construct($config);
    }
}

/*
 *     id: ID!
    author: Author!
    title: String
    content: String
    date: DateTime!
    comments: [Comment!]!
 */