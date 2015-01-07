<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 23:33
 */

namespace Virhi\LazyRestApiBundle\Api\Factory;


use Virhi\LazyRestApiBundle\Api\Resources\Context\Context;
use Virhi\LazyRestApiBundle\Api\Resources\Context\EntityContext;
use Virhi\LazyRestApiBundle\Api\Resources\ObjectStructureRessource;

class EntityResourceFactory extends ResourceFactory implements ResourceFactoryInterface
{
    /**
     * @param Context $context
     * @return Resource
     */
    static public function buildResource(Context $context)
    {
        if (! $context instanceof EntityContext) {
            throw new \RuntimeException("Wrong context");
        }

        $resource = new ObjectStructureRessource($context->getRouter(), $context->getEntity());
        return $resource;
    }

} 