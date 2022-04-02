<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Mutations;

use Doctrine\DBAL\Exception;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Api\Nodes\Genre;
use Oligus\GraphqlTalk\Modules\Genre as GenreEntity;

class UpdateGenre
{
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        /** @var GenreEntity $genre */
        $genre = $context->getEm()->getRepository(GenreEntity::class)->find($args['id']);

        if (!$genre) {
            throw new Exception('Artist not found.');
        }

        $genre->setName($args['name']);
        $context->getEm()->flush();

        return Genre::resolveFields($genre);
    }
}
