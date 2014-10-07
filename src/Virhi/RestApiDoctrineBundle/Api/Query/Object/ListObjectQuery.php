<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:35
 */

namespace Virhi\RestApiDoctrineBundle\Api\Query\Object;


use Virhi\Component\Query\Context\ContextInterface;
use Virhi\Component\Query\QueryInterface;

use Virhi\RestApiDoctrineBundle\Api\Query\Context\Object\ListObjectContext;
use Virhi\RestApiDoctrineBundle\Api\Repository\Object\ListFinder;
use Virhi\RestApiDoctrineBundle\Api\Search\ListObjectSearch;

class ListObjectQuery implements QueryInterface
{
    /**
     * @var ListFinder
     */
    protected $listFinder;

    function __construct(ListFinder $listFinder)
    {
        $this->listFinder = $listFinder;
    }


    public function execute(ContextInterface $context)
    {
        if (!$context instanceof ListObjectContext) {
            throw new \RuntimeException();
        }

        $search = new ListObjectSearch();
        return $this->listFinder->find($search);
    }
} 