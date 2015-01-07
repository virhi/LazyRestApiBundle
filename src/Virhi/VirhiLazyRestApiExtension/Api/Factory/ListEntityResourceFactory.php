<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 23:47
 */

namespace Virhi\LazyRestApiBundle\Api\Factory;

use Virhi\LazyRestApiBundle\Api\Resources\Context\Context;
use Virhi\LazyRestApiBundle\Api\Resources\Context\ListEntityContext;
use Virhi\LazyRestApiBundle\Api\Resources\Context\EntityContext;
use Virhi\LazyRestApiBundle\Api\Resources\ListEntityRessource;
use Virhi\LazyRestApiBundle\Api\Resources\EntityRessource;

class ListEntityResourceFactory extends ResourceFactory implements ResourceFactoryInterface
{
    /**
     * @param Context $context
     * @return Resource
     */
    static public function buildResource(Context $context)
    {
        if (! $context instanceof ListEntityContext) {
            throw new \RuntimeException("Wrong context");
        }

        $resource = new ListEntityRessource($context->getRouter(), $context->getList());
        return $resource;
    }

} 