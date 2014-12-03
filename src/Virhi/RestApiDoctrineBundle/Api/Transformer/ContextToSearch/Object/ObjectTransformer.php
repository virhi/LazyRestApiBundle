<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 03/12/2014
 * Time: 21:32
 */

namespace Virhi\RestApiDoctrineBundle\Api\Transformer\ContextToSearch\Object;

use Virhi\Component\Transformer\TransformerInterface;
use Virhi\RestApiDoctrineBundle\Api\Query\Context\Object\ObjectContext;
use Virhi\RestApiDoctrineBundle\Api\Search\ObjectSearch;
use Virhi\RestApiDoctrineBundle\Api\Service\EntityNamespaceService;

class ObjectTransformer implements TransformerInterface
{
    /**
     * @var EntityNamespaceService
     */
    protected $entityNamespaceService;

    function __construct(EntityNamespaceService $entityNamespaceService)
    {
        $this->entityNamespaceService = $entityNamespaceService;
    }

    public function transform($context)
    {
        if (!$context instanceof ObjectContext) {
            throw new \RuntimeException();
        }

        return new ObjectSearch($context->getName(), $this->entityNamespaceService->getEntityFullName($context->getName()));
    }
} 