<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Mutations;

use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\AppContext;
use Oligus\GraphqlTalk\Nodes\Artist;

class UpdateGenre
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $genres = $context->getJsonDB()
            ->select('*')
            ->from('genres.json')
            ->where(['id' => $args['id']])
            ->get();

        if (empty($genres)) {
            throw new Exception('Artist not found.');
        }

        $context->getJsonDB()->update( [ 'name' => $args['name']] )
            ->from( 'genres.json' )
            ->where( [ 'id' => $args['id'] ] )
            ->trigger();

        $genres = $context->getJsonDB()
            ->select('*')
            ->from('genres.json')
            ->where(['id' => $args['id']])
            ->get();

        return Artist::resolveFields(current($genres), $context);
    }
}
