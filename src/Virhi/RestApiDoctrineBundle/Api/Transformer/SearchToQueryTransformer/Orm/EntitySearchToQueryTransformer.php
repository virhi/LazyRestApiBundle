<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 17/11/2014
 * Time: 09:00
 */

namespace Virhi\RestApiDoctrineBundle\Api\Transformer\SearchToQueryTransformer\Orm;

use Virhi\Component\Search\SearchInterface;
use Virhi\RestApiDoctrineBundle\Api\Search\EntitySearch;

class EntitySearchToQueryTransformer 
{
    public function transform(SearchInterface $search)
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

        $query      = $qb->getQuery();

        return $qb->getQuery();
    }
} 