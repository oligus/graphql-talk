<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Mutations;

use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\AppContext;
use Oligus\GraphqlTalk\Nodes\Artist;

class RemoveGenre
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $genre = $context->getJsonDB()
            ->select('*')
            ->from('genres.json')
            ->where(['id' => $args['id']])
            ->get();

        if (empty($genre)) {
            throw new Exception('Genre not found.');
        }

        $context->getJsonDB()
            ->delete()
            ->from( 'genres.json' )
            ->where(['id' => $args['id']])
            ->trigger();

        return Artist::resolveFields(current($genre), $context);
    }
}
