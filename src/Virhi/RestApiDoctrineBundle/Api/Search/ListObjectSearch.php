<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:26
 */

namespace Virhi\RestApiDoctrineBundle\Api\Search;

use Virhi\Component\Search\Search;

class ListObjectSearch extends Search
{
    protected $onlyPrimary;

    function __construct($onlyPrimary = true)
    {
        $this->onlyPrimary = $onlyPrimary;
    }

    /**
     * @return boolean
     */
    public function isOnlyPrimary()
    {
        return $this->onlyPrimary;
    }
}