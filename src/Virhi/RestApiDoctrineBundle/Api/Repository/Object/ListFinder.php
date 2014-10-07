<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:01
 */

namespace Virhi\RestApiDoctrineBundle\Api\Repository\Object;


use Virhi\Component\Repository\ListFinderInterface;
use Virhi\Component\Repository\Repository;
use Virhi\Component\Search\SearchInterface;

class ListFinder extends Repository implements ListFinderInterface
{
    /**
     * @param SearchInterface $search
     * @return mixed
     */
    public function find(SearchInterface $search)
    {
        $doctrine   = $this->getDoctrine();
        $connection = $doctrine->getConnection();
        $sm         = $connection->getSchemaManager();

        return $sm->listTables();
    }

} 