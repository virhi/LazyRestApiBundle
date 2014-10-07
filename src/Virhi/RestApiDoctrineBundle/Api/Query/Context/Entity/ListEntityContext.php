<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 19:48
 */

namespace Virhi\RestApiDoctrineBundle\Api\Query\Context\Entity;

use Virhi\Component\Query\Context\ContextInterface;

class ListEntityContext implements ContextInterface
{
    protected $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

}