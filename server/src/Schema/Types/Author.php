<?php declare(strict_types=1);

namespace Server\Schema\Types;

use GraphQL\Type\Definition\ObjectType;
use Server\Schema\TypeManager;

/**
 * Class Author
 * @package Server\Schema\Types
 */
class Author extends ObjectType
{
    /**
     * Artist constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $config = [
            'name' => 'Author',
            'description' => 'Author of a post, comment or even both.',
            'fields' => function() {
                return [
                    'id' => ['type' => TypeManager::id()],
                    'name' => ['type' => TypeManager::string()]
                ];
            }
        ];

        parent::__construct($config);
    }
}
