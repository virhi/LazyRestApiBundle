<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:10
 */

namespace Virhi\RestApiDoctrineBundle\Api\Search;


use Virhi\Component\Search\Search;

class ObjectSearch extends Search
{
    /**
     * @var string
     */
    protected $name;

    protected $namespace;

    function __construct($name, $namespace)
    {
        $this->name = $name;
        $this->namespace = $namespace;
    }

    /**
     * @return string
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