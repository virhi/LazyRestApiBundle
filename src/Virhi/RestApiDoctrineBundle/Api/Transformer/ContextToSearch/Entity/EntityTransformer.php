<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 03/12/2014
 * Time: 21:18
 */

namespace Virhi\RestApiDoctrineBundle\Api\Transformer\ContextToSearch\Entity;

use Virhi\Component\Transformer\TransformerInterface;
use Virhi\RestApiDoctrineBundle\Api\Query\Context\Entity\EntityContext;
use Virhi\RestApiDoctrineBundle\Api\Search\EntitySearch;

class EntityTransformer implements TransformerInterface
{
    /**
     * @param $context
     * @return EntitySearch
     */
    public function transform($context)
    {
        if (!$context instanceof EntityContext) {
            throw new \RuntimeException();
        }

        $objectStructure = $context->getObjectStructure();
        $joins = array();

        foreach ($objectStructure->getEmbeded() as $embed) {
            foreach ($embed as $embeded) {
                $joins[] = $embeded->getFieldName();
            }
        }

        return new EntitySearch($context->getId(), $context->getName(), $objectStructure->getNamespace(), $joins, $objectStructure->getIdentifier());
    }
}