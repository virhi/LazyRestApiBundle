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
use Virhi\RestApiDoctrineBundle\Api\Service\ObjectService;
use Virhi\RestApiDoctrineBundle\Api\Service\EntityNamespaceService;
use Virhi\RestApiDoctrineBundle\Api\Search\ObjectSearch;

class ObjectQuery implements QueryInterface
{
    /**
     * @var ObjectService
     */
    protected $objectService;

    protected $entityNamespaceService;

    function __construct(ObjectService $objectService, EntityNamespaceService $entityNamespaceService)
    {
        $this->objectService = $objectService;
        $this->entityNamespaceService = $entityNamespaceService;
    }


    public function execute(ContextInterface $context)
    {
        if (!$context instanceof ObjectContext) {
            throw new \RuntimeException();
        }

        $search = new ObjectSearch($context->getName(), $this->entityNamespaceService->getEntityFullName($context->getName()));
        return $this->objectService->getObjectStructure($search);
    }
} 