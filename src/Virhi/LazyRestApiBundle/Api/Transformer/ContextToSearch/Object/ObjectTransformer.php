<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 03/12/2014
 * Time: 21:32
 */

namespace Virhi\LazyRestApiBundle\Api\Transformer\ContextToSearch\Object;

use Virhi\Component\Transformer\TransformerInterface;
use Virhi\LazyRestApiBundle\Api\Query\Context\Object\ObjectContext;
use Virhi\LazyRestApiBundle\Api\Search\ObjectSearch;
use Virhi\LazyRestApiBundle\Api\Service\EntityNamespaceService;

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