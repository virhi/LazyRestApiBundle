<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 27/10/2014
 * Time: 19:02
 */

namespace Virhi\LazyRestApiBundle\Api\Command;

use Virhi\Component\Command\CommandInterface;
use Virhi\Component\Command\Context\ContextInterface;
use Virhi\Component\Repository\AttacherInterface;
use Virhi\LazyRestApiBundle\Api\Service\EntityNamespaceService;
use Virhi\LazyRestApiBundle\Api\Command\Context\Context;
use Virhi\LazyRestApiBundle\Api\Transformer\FormDataToEntity\EntityTransformer;
use Virhi\LazyRestApiBundle\Api\Specification\AuthorizedEntityCreationSpecification;

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

    /**
     * @var EntityTransformer
     */
    protected $transformer;

    /**
     * @var AuthorizedEntityCreationSpecification
     */
    protected $authorizedEntityCreationSpecification;

    function __construct(AttacherInterface $attacher, EntityNamespaceService $entityNamespaceService, EntityTransformer $transformer, AuthorizedEntityCreationSpecification $authorizedEntityCreationSpecification)
    {
        $this->attacher               = $attacher;
        $this->entityNamespaceService = $entityNamespaceService;
        $this->transformer            = $transformer;
        $this->authorizedEntityCreationSpecification = $authorizedEntityCreationSpecification;
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

        if (!$this->authorizedEntityCreationSpecification->isSatisfiedBy($entityFullName)) {
            throw new \RuntimeException('invalide action');
        }

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