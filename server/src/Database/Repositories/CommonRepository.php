<?php declare(strict_types=1);

namespace Server\Database\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Class CommonRepository
 * @package Server\Database\Repositories
 */
class CommonRepository extends EntityRepository
{
    /**
     * @param array $args
     * @return mixed
     */
    public function filter(array $args)
    {
        $alias = 'alias_' . uniqid();

        /* @var \Doctrine\ORM\EntityManager $em */
        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder()->select($alias)
            ->from($this->_entityName, $alias);

        foreach(array_keys($args['filter']) as $col) {
            if(preg_match('/%/', $args['filter'][$col])) {
                $qb->where( $qb->expr()->like($alias . '.' . $col, ':' . $col));
            } else {
                $qb->where( $qb->expr()->eq($alias . '.' . $col, ':' . $col));
            }


            $qb->setParameter($col, $args['filter'][$col]);
        }

        $qb = $this->addPagination($qb, $args);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param QueryBuilder $qb
     * @param array $args
     * @return QueryBuilder
     */
    public function addPagination(QueryBuilder $qb, array $args): QueryBuilder
    {
        if(array_key_exists('first', $args)) {
            $qb->setMaxResults($args['first']);
        }

        if(array_key_exists('offset', $args)) {
            $qb->setFirstResult($args['offset']);
        }

        if(array_key_exists('after', $args)) {
            $qb->setFirstResult($args['after']);
        }

        return $qb;
    }

    /**
     * @param string $field
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCount($field = 'id'): int
    {
        $alias = 'alias_' . uniqid();

        /* @var \Doctrine\ORM\EntityManager $em */
        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder()->select('count(' . $alias . '.' . $field . ') AS count')
            ->from($this->_entityName, $alias);

        return (int) $qb->getQuery()->getSingleScalarResult();
    }
}
