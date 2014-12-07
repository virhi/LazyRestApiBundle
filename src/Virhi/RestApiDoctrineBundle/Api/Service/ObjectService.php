<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/10/2014
 * Time: 00:12
 */

namespace Virhi\RestApiDoctrineBundle\Api\Service;

use Virhi\RestApiDoctrineBundle\Api\Repository\Object\Finder;
use Virhi\RestApiDoctrineBundle\Api\Repository\Object\ListFinder;
use Virhi\RestApiDoctrineBundle\Api\Search\ObjectSearch;
use Virhi\RestApiDoctrineBundle\Api\Search\ListObjectSearch;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\ObjectStructure;

class ObjectService 
{
    /**
     * @var Finder
     */
    protected $finder;

    /**
     * @var ListFinder
     */
    protected $listFinder;


    function __construct(Finder $finder, ListFinder $listFinder)
    {
        $this->finder = $finder;
        $this->listFinder = $listFinder;
    }

    /**
     * @param ObjectSearch $search
     * @return ObjectStructure
     */
    public function getObjectStructure(ObjectSearch $search)
    {
        return $this->finder->find($search);
    }

    public function getListObjectStructure(ListObjectSearch $search)
    {
        return $this->listFinder->find($search);
    }
} 