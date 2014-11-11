<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/10/2014
 * Time: 00:12
 */

namespace Virhi\RestApiDoctrineBundle\Api\Service;

use Virhi\RestApiDoctrineBundle\Api\Repository\Object\Finder;
use Virhi\RestApiDoctrineBundle\Api\Search\ObjectSearch;

class ObjectService 
{
    /**
     * @var Finder
     */
    protected $finder;

    function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    public function getObjectStructure(ObjectSearch $search)
    {
        return $this->finder->find($search);
    }
} 