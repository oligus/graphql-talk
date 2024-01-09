<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Nodes;

use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\AppContext;

class Genre implements Node
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $result = $context->getJsonDB()
            ->select('*')
            ->from('genres.json')
            ->where(['id' => $args['id']])
            ->get();

        if (empty($result)) {
            throw new Exception('Genre not found.');
        }

        return self::resolveFields(current($result), $context);
    }

    public static function resolveFields(array $item, AppContext $context): array
    {
        return [
            'id' => $item['id'],
            'name' => $item['name']
        ];
    }
}
