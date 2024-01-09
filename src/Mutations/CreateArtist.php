<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Mutations;

use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Jajo\JSONDB;
use Oligus\GraphqlTalk\AppContext;
use Oligus\GraphqlTalk\Nodes\Artist;

class CreateArtist
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $result = $context->getJsonDB()
            ->select('id')
            ->from('artists.json')
            ->order_by( 'id', JSONDB::DESC)
            ->get();

        $result = current(array_slice($result, 0, 1));

        $artist = [
            'id' => empty($result) ? 1 : $result['id'] + 1,
            'name' => $args['name']
        ];

        $context->getJsonDB()->insert( 'artists.json', $artist);

        return Artist::resolveFields($artist, $context);
    }
}
