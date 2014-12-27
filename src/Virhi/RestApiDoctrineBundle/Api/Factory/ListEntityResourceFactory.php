<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 23:47
 */

namespace Virhi\RestApiDoctrineBundle\Api\Factory;

use Virhi\RestApiDoctrineBundle\Api\Resources\Context\Context;
use Virhi\RestApiDoctrineBundle\Api\Resources\Context\ListEntityContext;
use Virhi\RestApiDoctrineBundle\Api\Resources\Context\EntityContext;
use Virhi\RestApiDoctrineBundle\Api\Resources\ListEntityRessource;
use Virhi\RestApiDoctrineBundle\Api\Resources\EntityRessource;

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