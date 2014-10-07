<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:38
 */

namespace Virhi\RestApiDoctrineBundle\Api\Query\Entity;

use Virhi\Component\Query\Context\ContextInterface;
use Virhi\Component\Query\QueryInterface;
use Virhi\RestApiDoctrineBundle\Api\Repository\Entity\Finder;
use Virhi\RestApiDoctrineBundle\Api\Search\EntitySearch;
use Virhi\RestApiDoctrineBundle\Api\Query\Context\Entity\EntityContext;

class EntityQuery implements  QueryInterface
{
    /**
     * @var Finder
     */
    protected $finder;

    function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }


    public function execute(ContextInterface $context)
    {
        if (!$context instanceof EntityContext) {
            throw new \RuntimeException();
        }

        $search = new EntitySearch($context->getId(), $context->getName());

        return $this->finder->find($search);
    }

} 