<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 15:59
 */

namespace Virhi\RestApiDoctrineBundle\Api\Repository\Entity;

use Virhi\Component\Repository\Repository;
use Virhi\Component\Repository\ListFinderInterface;
use Virhi\Component\Search\SearchInterface;
use Virhi\RestApiDoctrineBundle\Api\Search\ListEntitySearch;

class ListFinder extends Repository implements ListFinderInterface
{
    /**
     * @param SearchInterface $search
     * @return mixed
     */
    public function find(SearchInterface $search)
    {
        if (!$search instanceof ListEntitySearch) {
            throw new \RuntimeException();
        }

        $qb = $this->getEntiteManager()->createQueryBuilder();
        $qb->select('x')
            ->from('VirhiSymfonyDomainBundle:' .ucfirst($search->getName()), 'x');

        $entitys = $qb->getQuery()->getArrayResult();

        return $entitys;
    }

} 