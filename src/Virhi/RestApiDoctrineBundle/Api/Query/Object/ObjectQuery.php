<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:37
 */

namespace Virhi\RestApiDoctrineBundle\Api\Query\Object;


use Virhi\Component\Query\Context\ContextInterface;
use Virhi\Component\Query\QueryInterface;

use Virhi\RestApiDoctrineBundle\Api\Query\Context\Object\ObjectContext;
use Virhi\RestApiDoctrineBundle\Api\Repository\Object\Finder;
use Virhi\RestApiDoctrineBundle\Api\Search\ObjectSearch;

class ObjectQuery implements QueryInterface
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
        if (!$context instanceof ObjectContext) {
            throw new \RuntimeException();
        }

        $search = new ObjectSearch($context->getName());
        return $this->finder->find($search);
    }

} 