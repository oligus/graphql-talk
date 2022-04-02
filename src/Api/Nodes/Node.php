<?php declare(strict_types=1);

namespace Oligus\GraphqlTalk\Api\Nodes;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NonUniqueResultException;

class Node
{
    /**
     * @throws NonUniqueResultException
     */
    public static function fetch(string $entityClass, string $id, EntityManager $em): array
    {
        $qb = $em->getRepository($entityClass)->createQueryBuilder('t');
        $qb->where($qb->expr()->eq('t.id', ':id'));
        $qb->setParameter('id', $id);
        $result = $qb->getQuery()->getOneOrNullResult(AbstractQuery::HYDRATE_ARRAY);
        return $result ?: [];
    }
}
