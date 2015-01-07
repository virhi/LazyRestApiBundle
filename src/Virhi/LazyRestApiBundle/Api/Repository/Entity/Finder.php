<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 15:59
 */

namespace Virhi\LazyRestApiBundle\Api\Repository\Entity;

use Virhi\Component\Repository\FinderInterface;
use Virhi\LazyRestApiBundle\Api\Repository\Repository as BaseRepository;
use Virhi\Component\Search\SearchInterface;
use Virhi\LazyRestApiBundle\Api\Search\EntitySearch;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;
use Virhi\LazyRestApiBundle\Api\Factory\ObjectStructureFactory;

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

        $qb = $this->createQueryBuilder();

        $qb->select('x')
            ->from($this->manager . ':' . ucfirst($search->getName()), 'x')
            ->where('x.'. $search->getIdentifier()[0].' = :id')
            ->setParameter('id', $search->getId())
        ;

        foreach ($search->getJoins() as $index => $join) {
            $alias = 'p'.$index;

            $qb->addSelect($alias);
            $qb->leftJoin('x.'.$join, $alias);
        }

        $query      = $qb->getQuery();
        return $query->getSingleResult($search->getHydratation());
    }
}