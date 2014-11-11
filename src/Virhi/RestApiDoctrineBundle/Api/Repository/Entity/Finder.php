<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 15:59
 */

namespace Virhi\RestApiDoctrineBundle\Api\Repository\Entity;

use Virhi\Component\Repository\FinderInterface;
use Virhi\RestApiDoctrineBundle\Api\Repository\Repository as BaseRepository;
use Virhi\Component\Search\SearchInterface;
use Virhi\RestApiDoctrineBundle\Api\Search\EntitySearch;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;

class Finder extends BaseRepository implements FinderInterface
{
    /**
     * @param SearchInterface $search
     * @return mixed
     */
    public function find(SearchInterface $search)
    {
        if (!$search instanceof EntitySearch) {
            throw new \RuntimeException();
        }

        $qb = $this->getEntiteManager()->createQueryBuilder();

        $qb->select('x')
            ->from($this->manager . ':' . ucfirst($search->getName()), 'x')
            ->where('x.id = :id')
            ->setParameter('id', $search->getId())
        ;

        foreach ($search->getJoins() as $index => $join) {
            $alias = 'p'.$index;

            $qb->addSelect($alias);
            $qb->join('x.'.$join, $alias);
        }


        $query   = $qb->getQuery();
        $entity  = $query->getSingleResult(AbstractQuery::HYDRATE_ARRAY);

        return $entity;
    }

    /**
     * @param QueryBuilder $qb
     * @param EntitySearch $search
     * @return \Doctrine\ORM\Query
     */
    public function getQuery(QueryBuilder $qb, EntitySearch $search)
    {
        $qb->select('x')
            ->addSelect('p')
            ->from($this->manager . ':' . ucfirst($search->getName()), 'x')
            ->join('x.tags', 'p')
            ->where('x.id = :id')
            ->setParameter('id', $search->getId())
        ;

        return $qb->getQuery();
    }

} 