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

    function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

} 