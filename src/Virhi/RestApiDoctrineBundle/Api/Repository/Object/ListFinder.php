<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:01
 */

namespace Virhi\RestApiDoctrineBundle\Api\Repository\Object;


use Virhi\Component\Repository\ListFinderInterface;
use Virhi\RestApiDoctrineBundle\Api\Repository\Repository as BaseRepository;
use Virhi\Component\Search\SearchInterface;
use Virhi\RestApiDoctrineBundle\Api\Search\ListObjectSearch;
use Doctrine\ORM\Tools\DisconnectedClassMetadataFactory;

class ListFinder extends BaseRepository implements ListFinderInterface
{
    /**
     * @param SearchInterface $search
     * @return mixed
     */
    public function find(SearchInterface $search)
    {
        if (!$search instanceof ListObjectSearch) {
            throw new \RuntimeException();
        }

        $result     = array();
        $entities   = $this->getListEntities();

        foreach ($this->getListTables() as $table) {
            if (in_array($table->getName(), $entities) ) {
                $result[] = $table;
            }
        }

        return $result;
    }

    protected function getListTables()
    {
        $doctrine   = $this->getDoctrine();
        $connection = $doctrine->getConnection();
        $sm         = $connection->getSchemaManager();

        return $sm->listTables();
    }

    protected function getListEntities()
    {
        $entities   = array();

        $em = clone $this->getEntiteManager();
        $em->getConfiguration()->setMetadataDriverImpl(
            new \Doctrine\ORM\Mapping\Driver\DatabaseDriver(
                $em->getConnection()->getSchemaManager()
            )
        );

        $cmf = new DisconnectedClassMetadataFactory();
        $cmf->setEntityManager($em);
        $metadata = $cmf->getAllMetadata();

        foreach ($metadata as $metadataclass) {
            $entities[] = $metadataclass->table["name"];
        }

        return $entities;
    }

} 