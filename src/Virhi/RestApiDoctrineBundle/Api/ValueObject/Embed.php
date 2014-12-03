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
    protected $fieldName;

    protected $listObjectStructure;

    function __construct($fieldName, array $listObjectStructure = array())
    {
        $this->fieldName            = $fieldName;
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

}