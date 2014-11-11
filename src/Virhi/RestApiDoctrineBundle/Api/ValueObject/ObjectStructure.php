<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/10/2014
 * Time: 21:59
 */

namespace Virhi\RestApiDoctrineBundle\Api\ValueObject;

use \ArrayObject;

class ObjectStructure 
{
    protected $name;
    protected $namespace;
    protected $fields;
    protected $embeded;
    protected $identifier;

    function __construct($name, $namespace)
    {
        $this->embeded = new ArrayObject();
        $this->fields = new ArrayObject();;
        $this->name = $name;
        $this->namespace = $namespace;
        $this->identifier = array();
    }

    /**
     * @return array
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param array $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }


    public function addField($field)
    {
        $this->fields->append($field);
    }

    public function addEmbeded($embeded)
    {
        $this->embeded->append($embeded);
    }

    /**
     * @return ArrayObject
     */
    public function getEmbeded()
    {
        return $this->embeded;
    }


    /**
     * @return ArrayObject
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }
}