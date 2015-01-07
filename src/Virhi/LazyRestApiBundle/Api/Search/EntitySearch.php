<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:10
 */

namespace Virhi\LazyRestApiBundle\Api\Search;

use Virhi\Component\Search\Search;

class EntitySearch extends Search
{
    protected $name;

    protected $namespace;

    protected $id;

    protected $joins;

    protected $identifier;

    function __construct($id, $name, $namespace,  array $joins, array $identifier)
    {
        parent::__construct();

        $this->id         = $id;
        $this->name       = $name;
        $this->joins      = $joins;
        $this->namespace  = $namespace;
        $this->identifier = $identifier;
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
     * @return array
     */
    public function getJoins()
    {
        return $this->joins;
    }

    /**
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @return array
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

}