<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Nodes;

use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\AppContext;

class Track implements Node
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $result = $context->getJsonDB()
            ->select('*')
            ->from('tracks.json')
            ->where(['id' => $args['id']])
            ->get();

        if (empty($result)) {
            throw new Exception('Album not found.');
        }

        return self::resolveFields(current($result), $context);
    }

    public static function resolveFields(array $item, AppContext $context): array
    {
        return [
            'id' => $item['id'],
            'name' => $item['name'],
            'album' => function() use ($item, $context) {
                $result = $context->getJsonDB()
                    ->select('*')
                    ->from('albums.json')
                    ->where(['id' => $item['albumId']])
                    ->get();

                return !empty($result)
                    ? Album::resolveFields(current($result), $context)
                    : null;
            },
            'mediaType' => function() use ($item, $context) {
                $result = $context->getJsonDB()
                    ->select('*')
                    ->from('mediatypes.json')
                    ->where(['id' => $item['albumId']])
                    ->get();

                return !empty($result)
                    ? MediaType::resolveFields(current($result), $context)
                    : null;
            },
            'genre' => function() use ($item, $context) {
                $result = $context->getJsonDB()
                    ->select('*')
                    ->from('genres.json')
                    ->where(['id' => $item['albumId']])
                    ->get();

                return !empty($result)
                    ? Genre::resolveFields(current($result), $context)
                    : null;
            },
            'composer' => $item['composer'],
            'milliseconds' => $item['milliseconds'],
            'bytes' => $item['bytes'],
            'unitPrice' => $item['unitPrice'],
        ];
    }
}
