<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 15:59
 */

namespace Virhi\RestApiDoctrineBundle\Api\Repository\Entity;

use Virhi\Component\Repository\FinderInterface;
use Virhi\Component\Repository\Repository;
use Virhi\Component\Search\SearchInterface;
use Virhi\RestApiDoctrineBundle\Api\Search\EntitySearch;
use Doctrine\ORM\AbstractQuery;

class Finder extends Repository implements FinderInterface
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
            ->from('VirhiSymfonyDomainBundle:' .ucfirst($search->getName()), 'x')
            ->where('x.id = :id')
            ->setParameter('id', $search->getId())
        ;

        $entity  = $qb->getQuery()->getSingleResult(AbstractQuery::HYDRATE_ARRAY);

        return $entity;
    }

} 