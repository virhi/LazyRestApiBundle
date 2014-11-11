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
use Virhi\RestApiDoctrineBundle\Api\Search\ObjectSearch;
use Virhi\RestApiDoctrineBundle\Api\Service\ObjectService;
use Doctrine\DBAL\Schema\Table;

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
     * @var ObjectService
     */
    protected $objectService;

    function __construct(AttacherInterface $attacher, EntityNamespaceService $entityNamespaceService, ObjectService $objectService)
    {
        $this->attacher = $attacher;
        $this->entityNamespaceService = $entityNamespaceService;
        $this->objectService = $objectService;
    }


    public function execute(ContextInterface $context)
    {
        if (!$context instanceof Context) {
            throw new \RuntimeException();
        }

        $entityFullName = $this->entityNamespaceService->getEntityFullName($context->getName());
        $entity = new $entityFullName();

        $search    = new ObjectSearch($context->getName(), $entityFullName);
        $structure = $this->objectService->getObjectStructure($search);

        $this->populEntity($structure, $entity, $context->getImputEntity());
        $this->attacher->attach($entity);
    }

    protected function populEntity(Table $table, $entity, $inputEntity)
    {

        foreach (get_object_vars($inputEntity) as $varName => $value) {
            if ($table->hasColumn($varName)){
                $entity->{'set'. ucfirst($varName)}($value);
            } else {
                throw new \RuntimeException('the property : ' . $varName . ' dos not exist for entity : ' . get_class($entity));
            }
        }

        var_dump($entity);
        die;
    }
} 