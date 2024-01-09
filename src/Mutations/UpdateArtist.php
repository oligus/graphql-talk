<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Mutations;

use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\AppContext;
use Oligus\GraphqlTalk\Nodes\Artist;

class UpdateArtist
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $artist = $context->getJsonDB()
            ->select('*')
            ->from('artists.json')
            ->where(['id' => $args['id']])
            ->get();

        if (empty($artist)) {
            throw new Exception('Artist not found.');
        }

        $context->getJsonDB()->update( [ 'name' => $args['name']] )
            ->from( 'artists.json' )
            ->where( [ 'id' => $args['id'] ] )
            ->trigger();

        $artist = $context->getJsonDB()
            ->select('*')
            ->from('artists.json')
            ->where(['id' => $args['id']])
            ->get();

        return Artist::resolveFields(current($artist), $context);
    }
}
