<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Nodes;

use Doctrine\DBAL\Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Modules\Track as TrackEntity;

class Track extends Node
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        /** @var TrackEntity $track */
        $track = $context->getEm()->getRepository(TrackEntity::class)->find($args['id']);

        if (empty($track)) {
            throw new Exception('Track not found.');
        }

        return self::resolveFields($track);
    }

    public static function resolveFields(TrackEntity $track): array
    {
        return [
            'id' => $track->id,
            'name' => $track->name,
            'album' => function() use ($track) {
                return !empty($track->album)
                    ? Album::resolveFields($track->album)
                    : null;
            },
            'mediaType' => function() use ($track) {
                return !empty($track->mediaType)
                    ? MediaType::resolveFields($track->mediaType)
                    : null;
            },
            'genre' => function() use ($track) {
                return !empty($track->genre)
                    ? Genre::resolveFields($track->genre)
                    : null;
            },
            'composer' => $track->composer,
            'milliseconds' => $track->milliseconds,
            'bytes' => $track->bytes,
            'unitPrice' => $track->unitPrice,
        ];
    }
}
