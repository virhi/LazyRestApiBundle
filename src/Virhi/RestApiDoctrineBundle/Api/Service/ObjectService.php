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
use Symfony\Component\EventDispatcher\EventDispatcher;
use Virhi\RestApiDoctrineBundle\Api\Event\Object\ListObjectEvent;
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

    protected $eventDispatcher;


    function __construct(Finder $finder, ListFinder $listFinder, EventDispatcher $eventDispatcher)
    {
        $this->finder = $finder;
        $this->listFinder = $listFinder;
        $this->eventDispatcher = $eventDispatcher;
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
        $rawList = $this->listFinder->find($search);
        $event   = new ListObjectEvent($rawList);
        $this->eventDispatcher->dispatch($event->getName(), $event);

        return $event->getList();
    }
} 