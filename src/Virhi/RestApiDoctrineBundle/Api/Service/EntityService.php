<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 03/12/2014
 * Time: 21:03
 */

namespace Virhi\RestApiDoctrineBundle\Api\Service;

use Virhi\Component\Search\SearchInterface;
use Virhi\Component\Repository\FinderInterface;
use Virhi\Component\Repository\ListFinderInterface;

use Virhi\RestApiDoctrineBundle\Api\Repository\Entity\Finder;
use Virhi\RestApiDoctrineBundle\Api\Repository\Entity\ListFinder;

class EntityService 
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
        $this->finder     = $finder;
        $this->listFinder = $listFinder;
    }


    public function find(SearchInterface $search)
    {
        return $this->finder->find($search);
    }

    public function findList(SearchInterface $search)
    {
        return $this->listFinder->find($search);
    }
} 