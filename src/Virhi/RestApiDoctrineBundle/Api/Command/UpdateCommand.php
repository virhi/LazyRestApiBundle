<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 04/12/2014
 * Time: 00:02
 */

namespace Virhi\RestApiDoctrineBundle\Api\Command;

use Virhi\Component\Command\CommandInterface;
use Virhi\Component\Command\Context\ContextInterface;
use Virhi\Component\Repository\AttacherInterface;
use Virhi\RestApiDoctrineBundle\Api\Command\Context\Context;
use Virhi\RestApiDoctrineBundle\Api\Transformer\FormDataToEntity\EntityTransformer;
use Virhi\RestApiDoctrineBundle\Api\Specification\AuthorizedEntityUpdateSpecification;
use Virhi\RestApiDoctrineBundle\Api\Service\EntityNamespaceService;

class UpdateCommand implements CommandInterface
{
    /**
     * @var AttacherInterface
     */
    protected $attacher;

    /**
     * @var EntityTransformer
     */
    protected $transformer;

    /**
     * @var AuthorizedEntityUpdateSpecification
     */
    protected $authorizedEntityUpdateSpecification;

    /**
     * @var EntityNamespaceService
     */
    protected $entityNamespaceService;

    function __construct(AttacherInterface $attacher, EntityTransformer $transformer, EntityNamespaceService $entityNamespaceService,AuthorizedEntityUpdateSpecification $authorizedEntityUpdateSpecification)
    {
        $this->attacher = $attacher;
        $this->transformer = $transformer;
        $this->authorizedEntityUpdateSpecification = $authorizedEntityUpdateSpecification;
        $this->entityNamespaceService = $entityNamespaceService;
    }

    public function execute(ContextInterface $context)
    {
        if (!$context instanceof Context) {
            throw new \RuntimeException();
        }

        $entityFullName = $this->entityNamespaceService->getEntityFullName($context->getName());

        if (!$this->authorizedEntityUpdateSpecification->isSatisfiedBy($entityFullName)) {
            throw new \RuntimeException('invalide action');
        }

        $objToTransform = array(
            'name'        => $context->getName(),
            'imputEntity' => $context->getImputEntity(),
        );

        $entity = $this->transformer->transform($objToTransform);
        $this->attacher->attach($entity);
    }
}