<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 28/10/2014
 * Time: 23:29
 */

namespace Virhi\RestApiDoctrineBundle\Api\Command\Context;

use Virhi\Component\Command\Context\ContextInterface;

class Context implements ContextInterface
{
    protected $name;

    protected $imputEntity;

    function __construct($name, $imputEntity)
    {
        $this->name = $name;
        $this->imputEntity = $imputEntity;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getImputEntity()
    {
        return $this->imputEntity;
    }

    /**
     * @param mixed $imputEntity
     */
    public function setImputEntity($imputEntity)
    {
        $this->imputEntity = $imputEntity;
    }

}