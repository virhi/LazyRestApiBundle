<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 08/11/2014
 * Time: 14:55
 */

namespace Virhi\RestApiDoctrineBundle\Api\Factory;

use Virhi\RestApiDoctrineBundle\Api\ValueObject\ObjectStructure;

class EntityFactory 
{
    static public function build(ObjectStructure $objectStructure, $entity)
    {
        foreach ($objectStructure->getFields() as $field) {
            if (array_key_exists($field->getName(), $entity)) {
                $field->setValue($entity[$field->getName()]);
            }
        }

        foreach ($objectStructure->getEmbeded() as $embed) {
            $embedValue = array();
            foreach ($entity[$embed->getFieldName()] as $tmpEmbedField) {
                $embedValue[$embed->getFieldName()] = $tmpEmbedField;
            }
        }

        return $objectStructure;
    }
} 