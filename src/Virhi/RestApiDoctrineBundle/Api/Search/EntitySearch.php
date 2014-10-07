<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:10
 */

namespace Virhi\RestApiDoctrineBundle\Api\Search;


use Virhi\Component\Search\Search;

class EntitySearch extends Search
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