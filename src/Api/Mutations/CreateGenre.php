<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Mutations;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use GraphQL\Type\Definition\ResolveInfo;
use Oligus\GraphqlTalk\Api\AppContext;
use Oligus\GraphqlTalk\Api\Nodes\Genre;
use Oligus\GraphqlTalk\Modules\Genre as GenreEntity;

class CreateGenre
{
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public static function resolve(array $rootValue, array $args, AppContext $context, ResolveInfo $resolveInfo): array
    {
        $genre = new GenreEntity();
        $genre->name = $args['name'];

        $context->getEm()->persist($genre);
        $context->getEm()->flush();

        return Genre::resolveFields($genre);
    }
}
