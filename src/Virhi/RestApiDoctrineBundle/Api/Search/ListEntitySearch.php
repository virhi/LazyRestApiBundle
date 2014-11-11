<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:59
 */

namespace Virhi\RestApiDoctrineBundle\Api\Search;

use Virhi\Component\Search\Search;

class ListEntitySearch extends Search
{
    protected $name;

    protected $joins;

    function __construct($name, array $joins = array())
    {
        $this->name  = $name;
        $this->joins = $joins;
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




} 