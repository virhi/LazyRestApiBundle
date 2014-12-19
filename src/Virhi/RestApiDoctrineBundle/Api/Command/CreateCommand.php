<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 27/10/2014
 * Time: 19:02
 */

namespace Virhi\RestApiDoctrineBundle\Api\Command;

use Virhi\Component\Command\CommandInterface;
use Virhi\Component\Command\Context\ContextInterface;
use Virhi\Component\Repository\AttacherInterface;
use Virhi\RestApiDoctrineBundle\Api\Service\EntityNamespaceService;
use Virhi\RestApiDoctrineBundle\Api\Command\Context\Context;
use Virhi\RestApiDoctrineBundle\Api\Transformer\FormDataToEntity\EntityTransformer;

class CreateCommand implements CommandInterface
{
    /**
     * @var AttacherInterface
     */
    protected $attacher;

    /**
     * @var EntityNamespaceService
     */
    protected $entityNamespaceService;

    protected $transformer;

    function __construct(AttacherInterface $attacher, EntityNamespaceService $entityNamespaceService, EntityTransformer $transformer)
    {
        $this->attacher               = $attacher;
        $this->entityNamespaceService = $entityNamespaceService;
        $this->transformer            = $transformer;
    }


    /**
     * @param ContextInterface $context
     */
    public function execute(ContextInterface $context)
    {
        if (!$context instanceof Context) {
            throw new \RuntimeException();
        }

        $entityFullName = $this->entityNamespaceService->getEntityFullName($context->getName());
        $entity = new $entityFullName();

        $objToTransform = array(
            'name'        => $context->getName(),
            'imputEntity' => $context->getImputEntity(),
            'entity'      => $entity,
        );

        $entity = $this->transformer->transform($objToTransform);
        $this->attacher->attach($entity);
    }
}