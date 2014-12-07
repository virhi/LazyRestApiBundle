<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/12/2014
 * Time: 22:30
 */

namespace Virhi\RestApiDoctrineBundle\Api\Transformer\FormDataToEntity;

use Virhi\Component\Transformer\TransformerInterface;

use Doctrine\Common\Collections\ArrayCollection;
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


class EntityTransformer implements TransformerInterface
{
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

    function __construct(EntityNamespaceService $entityNamespaceService, ObjectService $objectService, EntityService $entityService)
    {
        $this->entityNamespaceService = $entityNamespaceService;
        $this->objectService          = $objectService;
        $this->entityService          = $entityService;
    }

    public function transform($obj)
    {
        $name           = $obj['name'];
        $imputEntity    = $obj['imputEntity'];
        $entityFullName = $this->entityNamespaceService->getEntityFullName($name);
        $search         = new ObjectSearch($name, $entityFullName);
        $structure      = $this->objectService->getObjectStructure($search);

        $entity = null;

        if (array_key_exists('entity', $obj)) {
            $entity = $obj['entity'];
        } else {

            $searchEntity = new EntitySearch(
                $imputEntity->{$structure->getIdentifier()[0]},
                $name,
                $entityFullName,
                array(),
                $structure->getIdentifier()
            );

            $entity = $this->getEntity($searchEntity);
        }
        $this->populEntity($structure, $entity, $imputEntity);

        return $entity;
    }

    protected function populEntity(ObjectStructure $table, $entity, $inputEntity)
    {
        $embedFieldNames = array();

        foreach ($table->getEmbeded() as $embeded) {
            foreach ($embeded as $embed) {
                $embedFieldNames[$embed->getFieldName()] = $embed->getEntityName();
            }
        }

        foreach (get_object_vars($inputEntity) as $varName => $value) {
            if (!array_key_exists($varName, $embedFieldNames)) {
                if ($table->hasField($varName)) {
                    $entity->{'set'. ucfirst($varName)}($value);
                }
            } else {
                $valueToSave = array();
                foreach ($value as $valueId) {
                    $info          = $this->getEntityInfo($valueId, $embedFieldNames[$varName]);
                    $valueToSave[] = $info['entity'];
                }
                $entity->{'set'. ucfirst($varName)}(new ArrayCollection($valueToSave));
            }
        }
    }

    protected function getEntityInfo($id, $name)
    {
        $result = array();

        $entityFullName  = $this->entityNamespaceService->getEntityFullName($name);
        $search          = new ObjectSearch($name, $entityFullName);
        $structure       = $this->objectService->getObjectStructure($search);

        $searchEntity = new EntitySearch(
            $id,
            $name,
            $entityFullName,
            array(),
            $structure->getIdentifier()
        );
        $result['structure']  = $structure;
        $result['entity']     = $this->getEntity($searchEntity);

        return $result;
    }

    protected function  getEntity(EntitySearch $search)
    {
        $search->setHydratation(AbstractQuery::HYDRATE_OBJECT);
        $entity = $this->entityService->find($search);

        return $entity;
    }
} 