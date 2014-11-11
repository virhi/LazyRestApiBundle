<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/10/2014
 * Time: 22:52
 */

namespace Virhi\RestApiDoctrineBundle\Api\Factory;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Schema\Table;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\ObjectStructure;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\Field;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\Embed;

class ObjectStructureFactory 
{
    static public function build(EntityManager $em, ClassMetadata $metadata, Table $table)
    {
        $structure = new ObjectStructure($metadata->getName(), $metadata->namespace);

        $structure->setIdentifier($metadata->getIdentifier());

        foreach ($metadata->fieldMappings as $rawField) {
            $column = $table->getColumn($rawField['columnName']);

            $field = new Field();
            $field->setName($rawField['fieldName']);
            $field->setType($column->getType());
            $field->getAutoIncrement($column->getAutoincrement());
            $field->setLength($column->getLength());
            $field->setComment($column->getComment());
            $field->setDefinition($column->getColumnDefinition());
            $field->setNotnull($column->getNotnull());

            $structure->addField($field);
        }

        foreach ($metadata->getAssociationMappings() as $mapping)
        {
            $tmpMetadata = $em->getClassMetadata($mapping['targetEntity']);

            $embed = new Embed();
            $embed->setEntityName($mapping['targetEntity']);
            $embed->setFieldName($mapping['fieldName']);
            $embed->setIdentifiers($tmpMetadata->identifier);

            $structure->addEmbeded($embed);
        }

        return $structure;
    }
}