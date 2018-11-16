<?php declare(strict_types=1);

namespace Server\Schema\Types\Inputs;

use Server\Schema\TypeManager;
use GraphQL\Type\Definition\InputObjectType;

/**
 * Class CommentInputType
 * @package Server\Schema\Types\Inputs
 */
class CommentInputType extends InputObjectType
{
    /**
     * PostInputType constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $config = [
            'name' => 'CommentInputType',
            'description' => 'Comment item input type',
            'fields' => [
                'authorId' => [
                    'type' => TypeManager::nonNull(TypeManager::id()),
                    'description' => 'Comment author'
                ],
                'postId' => [
                    'type' => TypeManager::nonNull(TypeManager::id()),
                    'description' => 'Post'
                ],
                'title' => [
                    'type' => TypeManager::string(),
                    'description' => 'Comment title'
                ],
                'content' => [
                    'type' => TypeManager::string(),
                    'description' => 'Comment content'
                ],

            ]
        ];

        parent::__construct($config);
    }
}
