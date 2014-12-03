<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:00
 */

namespace Virhi\RestApiDoctrineBundle\Api\Repository\Object;

use Virhi\Component\Repository\FinderInterface;
use Virhi\RestApiDoctrineBundle\Api\Factory\ObjectStructureFactory;
use Virhi\RestApiDoctrineBundle\Api\Repository\Repository as BaseRepository;
use Virhi\Component\Search\SearchInterface;
use Virhi\RestApiDoctrineBundle\Api\Search\ObjectSearch;

class Finder extends BaseRepository implements FinderInterface
{
    /**
     * @param SearchInterface $search
     * @return mixed
     */
    public function find(SearchInterface $search)
    {
        if (!$search instanceof ObjectSearch) {
            throw new \RuntimeException();
        }

        $table      = ObjectStructureFactory::getTables($this->getDoctrine(), $search->getName());
        $metadata   = ObjectStructureFactory::getEntityMetadata($this->getDoctrine(), $search->getNamespace());

        return ObjectStructureFactory::buildObjectStructure($this->getDoctrine(), $metadata, $table);
    }
}