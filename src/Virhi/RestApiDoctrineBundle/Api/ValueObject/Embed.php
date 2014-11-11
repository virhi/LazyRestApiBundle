<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/10/2014
 * Time: 23:13
 */

namespace Virhi\RestApiDoctrineBundle\Api\ValueObject;


class Embed 
{
    protected $entityName;

    protected $fieldName;

    protected $identifiers;

    protected $value;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getEntityName()
    {
        return $this->entityName;
    }

    /**
     * @param mixed $entityName
     */
    public function setEntityName($entityName)
    {
        $this->entityName = $entityName;
    }

    /**
     * @return mixed
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * @param mixed $fieldName
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;
    }

    /**
     * @return mixed
     */
    public function getIdentifiers()
    {
        return $this->identifiers;
    }

    /**
     * @param mixed $identifiers
     */
    public function setIdentifiers($identifiers)
    {
        $this->identifiers = $identifiers;
    }

}