<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:37
 */

namespace Virhi\RestApiDoctrineBundle\Api\Query\Entity;

use Virhi\RestApiDoctrineBundle\Api\Query\Context\Entity\ListEntityContext;
use Virhi\Component\Query\Context\ContextInterface;
use Virhi\Component\Query\QueryInterface;
use Virhi\RestApiDoctrineBundle\Api\Repository\Entity\ListFinder;
use Virhi\RestApiDoctrineBundle\Api\Search\ListEntitySearch;

class ListEntityQuery implements  QueryInterface
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
        if (!$context instanceof ListEntityContext) {
            throw new \RuntimeException();
        }

        $search = new ListEntitySearch($context->getName());

        return $this->listFinder->find($search);
    }

} 