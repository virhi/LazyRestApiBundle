<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:00
 */

namespace Virhi\RestApiDoctrineBundle\Api\Repository\Object;

use Virhi\Component\Repository\FinderInterface;
use Virhi\Component\Repository\Repository;
use Virhi\Component\Search\SearchInterface;
use Virhi\RestApiDoctrineBundle\Api\Search\ObjectSearch;

class Finder extends Repository implements FinderInterface
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

        $doctrine   = $this->getDoctrine();

        $connection = $doctrine->getConnection();
        $sm         = $connection->getSchemaManager();
        $table      = $sm->listTableDetails($search->getName());

        return $table;
    }

} 