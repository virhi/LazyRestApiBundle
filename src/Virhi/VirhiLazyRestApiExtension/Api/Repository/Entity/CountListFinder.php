<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 27/12/14
 * Time: 02:06
 */

namespace Virhi\LazyRestApiBundle\Api\Repository\Entity;

use Virhi\LazyRestApiBundle\Api\Repository\Repository as BaseRepository;
use Virhi\Component\Repository\ListFinderInterface;
use Virhi\Component\Search\SearchInterface;
use Virhi\LazyRestApiBundle\Api\Search\ListEntitySearch;

class CountListFinder extends BaseRepository implements ListFinderInterface
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
        $qb->select('count(x)')
            ->from($this->manager . ':' .ucfirst($search->getName()), 'x');


        return $qb->getQuery()->getSingleScalarResult();
    }
} 