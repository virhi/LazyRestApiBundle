<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 15:59
 */

namespace Virhi\RestApiDoctrineBundle\Api\Repository\Entity;

use Virhi\RestApiDoctrineBundle\Api\Repository\Repository as BaseRepository;
use Virhi\Component\Repository\ListFinderInterface;
use Virhi\Component\Search\SearchInterface;
use Virhi\RestApiDoctrineBundle\Api\Search\ListEntitySearch;


class ListFinder extends BaseRepository implements ListFinderInterface
{
    /**
     * @param SearchInterface $search
     * @return mixed
     */
    public function find(SearchInterface $search)
    {
        $result = array();
        if (!$search instanceof ListEntitySearch) {
            throw new \RuntimeException();
        }

        $qb = $this->createQueryBuilder();
        $qb->select('x')
            ->from($this->manager . ':' .ucfirst($search->getName()), 'x');

        foreach ($search->getJoins() as $index => $join) {
            $alias = 'p'.$index;

            $qb->addSelect($alias);
            $qb->leftJoin('x.'.$join, $alias);
        }

        return $qb->getQuery()->getArrayResult();
    }

} 