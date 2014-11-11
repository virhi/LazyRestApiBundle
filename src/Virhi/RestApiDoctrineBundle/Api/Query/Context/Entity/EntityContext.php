<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 19:48
 */

namespace Virhi\RestApiDoctrineBundle\Api\Query\Context\Entity;


use Virhi\Component\Query\Context\ContextInterface;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\ObjectStructure;

class EntityContext implements ContextInterface
{
    protected $name;

    protected $id;

    /**
     * @var ObjectStructure
     */
    protected $objectStructure;

    function __construct($id, $name, ObjectStructure $objectStructure)
    {
        $this->id   = $id;
        $this->name = $name;
        $this->objectStructure = $objectStructure;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return ObjectStructure
     */
    public function getObjectStructure()
    {
        return $this->objectStructure;
    }

}