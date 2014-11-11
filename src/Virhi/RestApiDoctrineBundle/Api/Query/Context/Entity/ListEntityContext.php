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

class ListEntityContext implements ContextInterface
{
    protected $name;

    /**
     * @var ObjectStructure
     */
    protected $objectStructure;

    function __construct($name, ObjectStructure $objectStructure)
    {
        $this->name = $name;
        $this->objectStructure = $objectStructure;
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