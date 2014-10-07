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