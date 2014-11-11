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
use Doctrine\DBAL\Schema\MySqlSchemaManager;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\DBAL\Schema\Table;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\ObjectStructure;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\Field;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\Embed;

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

        $doctrine   = $this->getDoctrine();
        $connection = $doctrine->getConnection();

        $sm         = $connection->getSchemaManager();
        $table      = $sm->listTableDetails($search->getName());

        $metadata = $this->getDoctrine()->getEntityManager()->getClassMetadata($search->getNamespace());
        return ObjectStructureFactory::build($this->getDoctrine()->getEntityManager(), $metadata, $table);
    }



} 