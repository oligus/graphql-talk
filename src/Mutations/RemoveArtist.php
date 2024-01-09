<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Mutations;

use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\AppContext;
use Oligus\GraphqlTalk\Nodes\Artist;

class RemoveArtist
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

        $context->getJsonDB()
            ->delete()
            ->from( 'artists.json' )
            ->where(['id' => $args['id']])
            ->trigger();

        return Artist::resolveFields(current($artist), $context);
    }
}
