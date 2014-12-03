<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 03/12/2014
 * Time: 21:19
 */

namespace Virhi\RestApiDoctrineBundle\Api\Transformer\ContextToSearch\Entity;

use Virhi\Component\Transformer\TransformerInterface;
use Virhi\RestApiDoctrineBundle\Api\Query\Context\Entity\ListEntityContext;
use Virhi\RestApiDoctrineBundle\Api\Search\ListEntitySearch;

class ListEntityTransformer implements TransformerInterface
{
    /**
     * @param $context
     * @return EntitySearch
     */
    public function transform($context)
    {
        $result = null;
        if (!$context instanceof ListEntityContext) {
            throw new \RuntimeException();
        }

        $objectStructure = $context->getObjectStructure();
        $joins = array();

        foreach ($objectStructure->getEmbeded() as $embed) {
            foreach ($embed as $embeded) {
                $joins[] = $embeded->getFieldName();
            }
        }

        return new ListEntitySearch($context->getName(), $context->getObjectStructure()->getNamespace(), $joins);
    }
} 