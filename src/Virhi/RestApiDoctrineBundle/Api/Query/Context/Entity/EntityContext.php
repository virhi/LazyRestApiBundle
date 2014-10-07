<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 19:48
 */

namespace Virhi\RestApiDoctrineBundle\Api\Query\Context\Entity;


use Virhi\Component\Query\Context\ContextInterface;

class EntityContext implements ContextInterface
{
    protected $name;

    protected $id;

    function __construct($id, $name)
    {
        $this->id   = $id;
        $this->name = $name;
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



} 