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
use Virhi\RestApiDoctrineBundle\Api\Service\EntityNamespaceService;
use Virhi\RestApiDoctrineBundle\Api\Command\Context\Context;
use Virhi\RestApiDoctrineBundle\Api\Search\ObjectSearch;
use Virhi\RestApiDoctrineBundle\Api\Search\EntitySearch;
use Virhi\RestApiDoctrineBundle\Api\Service\EntityService;
use Virhi\RestApiDoctrineBundle\Api\Service\ObjectService;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\ObjectStructure;
use Doctrine\ORM\AbstractQuery;

class UpdateCommand implements CommandInterface
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
     * @var ObjectService
     */
    protected $objectService;

    /**
     * @var EntityService
     */
    protected $entityService;

    function __construct(AttacherInterface $attacher, EntityNamespaceService $entityNamespaceService, ObjectService $objectService, EntityService $entityService)
    {
        $this->attacher               = $attacher;
        $this->entityNamespaceService = $entityNamespaceService;
        $this->objectService          = $objectService;
        $this->entityService          = $entityService;
    }


    public function execute(ContextInterface $context)
    {
        if (!$context instanceof Context) {
            throw new \RuntimeException();
        }

        $entityFullName = $this->entityNamespaceService->getEntityFullName($context->getName());

        $search    = new ObjectSearch($context->getName(), $entityFullName);
        $structure = $this->objectService->getObjectStructure($search);

        $entitySearch = new EntitySearch(
            $context->getImputEntity()->{$structure->getIdentifier()[0]},
            $context->getName(),
            $entityFullName,
            array(),
            $structure->getIdentifier()
        );

        $entitySearch->setHydratation(AbstractQuery::HYDRATE_OBJECT);
        $entity = $this->entityService->find($entitySearch);

        $this->populEntity($structure, $entity, $context->getImputEntity());
        $this->attacher->attach($entity);
    }

    protected function populEntity(ObjectStructure $table, $entity, $inputEntity)
    {
        foreach (get_object_vars($inputEntity) as $varName => $value) {
            if ($table->hasField($varName)){
                $entity->{'set'. ucfirst($varName)}($value);
            } else {
                throw new \RuntimeException('the property : ' . $varName . ' dos not exist for entity : ' . get_class($entity));
            }
        }
    }
} 