<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/10/2014
 * Time: 23:13
 */

namespace Virhi\LazyRestApiBundle\Api\ValueObject;


class Embed 
{
    protected $fieldName;

    protected $entityName;

    protected $listObjectStructure;

    function __construct($fieldName, $entityName, array $listObjectStructure = array())
    {
        $this->fieldName           = $fieldName;
        $this->entityName          = $entityName;
        $this->listObjectStructure = new \ArrayObject();
        $this->addObjectStructure($listObjectStructure);
    }

    /**
     * @return mixed
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    protected function addObjectStructure($listObjectStructure)
    {
        foreach ($listObjectStructure as $index => $objectStructure) {
            $this->listObjectStructure->offsetSet($index, $objectStructure);
        }
    }

    /**
     * @return \ArrayObject
     */
    public function getListObjectStructure()
    {
        return $this->listObjectStructure;
    }

    /**
     * @return mixed
     */
    public function getEntityName()
    {
        return $this->entityName;
    }



}