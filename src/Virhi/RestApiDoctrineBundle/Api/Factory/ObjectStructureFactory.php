<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/10/2014
 * Time: 22:52
 */

namespace Virhi\RestApiDoctrineBundle\Api\Factory;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Schema\Table;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\ObjectStructure;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\Field;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\Embed;

class ObjectStructureFactory 
{
    static public function buildObjectStructure(RegistryInterface $doctrine, ClassMetadata $metadata, Table $table, $entity = array())
    {
        $structure = new ObjectStructure($metadata->getName(), $metadata->namespace);
        $structure->setIdentifier($metadata->getIdentifier());

        foreach ($metadata->fieldMappings as $rawField) {
            $column = $table->getColumn($rawField['columnName']);

            $field = new Field();
            $field->setName($rawField['fieldName']);
            $field->setType($column->getType());
            $field->setAutoIncrement($column->getAutoincrement());
            $field->setLength($column->getLength());
            $field->setComment($column->getComment());
            $field->setDefinition($column->getColumnDefinition());
            $field->setNotnull($column->getNotnull());

            if (array_key_exists($rawField['fieldName'], $entity)) {
                $field->setValue($entity[$rawField['fieldName']]);
            }

            $structure->addField($field);
        }

        foreach ($metadata->getAssociationMappings() as $mapping)
        {
            $namespace     = $mapping['targetEntity'];
            $entityInfo    = explode('\\', $namespace);
            $entityName    = strtolower(end($entityInfo));

            $tableEmbed    = self::getTables($doctrine, $entityName);
            $metadataEmbed = self::getEntityMetadata($doctrine, $namespace);
            $listEmbedObjectStructure = array();

            if (array_key_exists($mapping['fieldName'], $entity)) {
                $embedEntities = $entity[$mapping['fieldName']];
                foreach ($embedEntities as $embedEntity ) {
                    $listEmbedObjectStructure[] = self::buildObjectStructure($doctrine, $metadataEmbed, $tableEmbed, $embedEntity);
                }
            }

            $embed = new Embed($mapping['fieldName'], $entityName, $listEmbedObjectStructure);
            $structure->addEmbeded($embed);
        }

        return $structure;
    }

    static public function getTables(RegistryInterface $doctrine, $name)
    {
        $doctrine   = clone $doctrine;
        $connection = $doctrine->getConnection();
        $sm         = $connection->getSchemaManager();

        return $sm->listTableDetails($name);
    }

    static public function getEntityMetadata(RegistryInterface $doctrine, $namespace)
    {
        $doctrine   = clone $doctrine;
        return $doctrine->getEntityManager()->getClassMetadata($namespace);
    }
}