<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:37
 */

namespace Virhi\RestApiDoctrineBundle\Api\Query\Entity;

use Virhi\RestApiDoctrineBundle\Api\Query\Context\Entity\ListEntityContext;
use Virhi\Component\Query\Context\ContextInterface;
use Virhi\Component\Query\QueryInterface;
use Virhi\RestApiDoctrineBundle\Api\Repository\Entity\ListFinder;
use Virhi\RestApiDoctrineBundle\Api\Search\ListEntitySearch;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\ObjectStructure;

class ListEntityQuery implements  QueryInterface
{
    /**
     * @var ListFinder
     */
    protected $listFinder;

    function __construct(ListFinder $listFinder)
    {
        $this->listFinder = $listFinder;
    }


    public function execute(ContextInterface $context)
    {
        $result = null;
        if (!$context instanceof ListEntityContext) {
            throw new \RuntimeException();
        }

        $joins = array();

        foreach ($context->getObjectStructure()->getEmbeded() as $embed) {
            $joins[] = $embed->getFieldName();
        }

        $search  = new ListEntitySearch($context->getName(), $joins);
        $entitys = $this->listFinder->find($search);


        $name      = $context->getObjectStructure()->getName();
        $namespace = $context->getObjectStructure()->getNamespace();

        foreach($entitys as $entity) {
            $objectStructure = new ObjectStructure($name, $namespace);
            foreach ($context->getObjectStructure()->getFields() as $field) {
                $tmpField = clone $field;
                if (array_key_exists($field->getName(), $entity)) {
                    $tmpField->setValue($entity[$field->getName()]);
                }
                $objectStructure->addField($tmpField);
            }

            foreach ($context->getObjectStructure()->getEmbeded() as $embed) {
                $tembed = clone $embed;
                foreach ($entity[$embed->getFieldName()] as $tmpEmbedField) {
                    $tembed->setValue($tmpEmbedField);
                    $objectStructure->addEmbeded($tembed);
                }
            }
            $result[] = $objectStructure;
        }

        return $result;
    }

} 