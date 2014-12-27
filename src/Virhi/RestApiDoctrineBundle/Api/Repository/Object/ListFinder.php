<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:01
 */

namespace Virhi\RestApiDoctrineBundle\Api\Repository\Object;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Virhi\Component\Repository\ListFinderInterface;
use Virhi\RestApiDoctrineBundle\Api\Repository\Repository as BaseRepository;
use Virhi\Component\Search\SearchInterface;
use Virhi\RestApiDoctrineBundle\Api\Search\ListObjectSearch;
use Doctrine\ORM\Tools\DisconnectedClassMetadataFactory;
use Doctrine\ORM\Mapping\ClassMetadataFactory;
use Virhi\RestApiDoctrineBundle\Api\Factory\ObjectStructureFactory;
use Virhi\RestApiDoctrineBundle\Api\Service\EntityNamespaceService;

class ListFinder extends BaseRepository implements ListFinderInterface
{
    /**
     * @var EntityNamespaceService
     */
    protected $entityNamespaceService;

    function __construct(RegistryInterface $doctrine, EntityManagerInterface $entiteManager, $manager, EntityNamespaceService $entityNamespaceService)
    {
        parent::__construct($doctrine, $entiteManager, $manager);
        $this->entityNamespaceService = $entityNamespaceService;
    }

    /**
     * @param SearchInterface $search
     * @return mixed
     */
    public function find(SearchInterface $search)
    {
        $result = array();

        if (!$search instanceof ListObjectSearch) {
            throw new \RuntimeException();
        }

        $em        = $this->getDoctrine()->getManager();
        $metadatas = $em->getMetadataFactory()->getAllMetadata();

        foreach ($metadatas as $tmpMetadata) {
            $metadata       = $this->getDoctrine()->getEntityManager()->getClassMetadata($tmpMetadata->getName());
            $table          = $this->getTable($tmpMetadata->table["name"]);
            $objStructure   = ObjectStructureFactory::buildObjectStructure($this->getDoctrine(), $metadata, $table);
            $result[]       = $objStructure;
        }

        return $result;
    }

    protected function getTable($tableName)
    {
        $doctrine   = $this->getDoctrine();
        $connection = $doctrine->getConnection();

        $sm         = $connection->getSchemaManager();
        return $sm->listTableDetails($tableName);
    }
} 