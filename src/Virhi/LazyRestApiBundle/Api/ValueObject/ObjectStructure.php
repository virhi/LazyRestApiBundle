<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/10/2014
 * Time: 21:59
 */

namespace Virhi\LazyRestApiBundle\Api\ValueObject;

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


    public function addField(Field $field)
    {
        $this->fields->offsetSet($field->getName(), $field);
    }

    public function hasField($field)
    {
        return $this->fields->offsetExists($field);
    }

    public function addEmbeded(Embed $embeded)
    {
        $list = new \ArrayObject();
        if ($this->embeded->offsetExists($embeded->getFieldName())) {
            $list = $this->embeded->offsetGet($embeded->getFieldName());
        }

        $list->append($embeded);
        $this->embeded->offsetSet($embeded->getFieldName(), $list);
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