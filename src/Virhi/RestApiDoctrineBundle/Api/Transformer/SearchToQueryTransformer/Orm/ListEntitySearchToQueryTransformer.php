<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 17/11/2014
 * Time: 08:55
 */

namespace Virhi\RestApiDoctrineBundle\Api\Transformer\SearchToQueryTransformer\Orm;

use Virhi\Component\Search\SearchInterface;
use Virhi\RestApiDoctrineBundle\Api\Search\ListEntitySearch;

class ListEntitySearchToQueryTransformer 
{
    public function transform(SearchInterface $search)
    {
        if (!$search instanceof ListEntitySearch) {
            throw new \RuntimeException();
        }

        $qb = $this->getEntiteManager()->createQueryBuilder();
        $qb->select('x')
            ->from($this->manager . ':' .ucfirst($search->getName()), 'x');

        foreach ($search->getJoins() as $index => $join) {
            $alias = 'p'.$index;

            $qb->addSelect($alias);
            $qb->join('x.'.$join, $alias);
        }

        return $qb->getQuery();
    }
} 