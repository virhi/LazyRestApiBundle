<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 16/12/2014
 * Time: 22:24
 */

namespace Virhi\LazyRestApiBundle\Api\Command\Context;

use Virhi\Component\Command\Context\ContextInterface;
use Virhi\LazyRestApiBundle\Api\ValueObject\ObjectStructure;

class RemoveContext implements ContextInterface
{
    protected $name;

    protected $id;

    /**
     * @var ObjectStructure
     */
    protected $objectStructure;

    function __construct($id, $name, $objectStructure)
    {
        $this->id = $id;
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