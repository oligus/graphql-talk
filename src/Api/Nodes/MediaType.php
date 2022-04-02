<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Nodes;

use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Modules\MediaType as MediaTypeEntity;

class MediaType extends Node
{
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        /** @var MediaTypeEntity $mediaType */
        $mediaType = $context->getEm()->getRepository(MediaTypeEntity::class)->find($args['id']);

        return self::resolveFields($mediaType);
    }

    public static function resolveFields(MediaTypeEntity $mediaType): array
    {
        return [
            'id' => $mediaType->id,
            'name' => $mediaType->name
        ];
    }
}
