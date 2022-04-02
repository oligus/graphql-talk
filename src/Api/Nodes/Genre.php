<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Nodes;

use Doctrine\DBAL\Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Modules\Genre as GenreEntity;

class Genre
{
    /**
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        /** @var GenreEntity $genre */
        $genre = $context->getEm()->getRepository(GenreEntity::class)->find($args['id']);

        if (empty($genre)) {
            throw new Exception('Genre not found.');
        }

        return self::resolveFields($genre);
    }

    public static function resolveFields(GenreEntity $genre): array
    {
        return [
            'id' => $genre->id,
            'name' => $genre->name
        ];
    }
}
