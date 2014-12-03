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
use Virhi\RestApiDoctrineBundle\Api\Factory\ObjectStructureFactory;

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

        $qb = $this->getEntiteManager()->createQueryBuilder();
        $qb->select('x')
            ->from($this->manager . ':' .ucfirst($search->getName()), 'x');

        foreach ($search->getJoins() as $index => $join) {
            $alias = 'p'.$index;

            $qb->addSelect($alias);
            $qb->leftJoin('x.'.$join, $alias);
        }

        $entities  = $qb->getQuery()->getArrayResult();
        $namespace = $search->getNamespace() .'\\'.ucfirst($search->getName());

        foreach ($entities as $entity) {
            $table      = ObjectStructureFactory::getTables($this->getDoctrine(), $search->getName());
            $metadata   = ObjectStructureFactory::getEntityMetadata($this->getDoctrine(), $namespace);

            $result[]   = ObjectStructureFactory::buildObjectStructure($this->getDoctrine(), $metadata, $table, $entity);
        }

        return $result;
    }

} 