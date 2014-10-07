<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 16:28
 */

namespace Virhi\RestApiDoctrineBundle\Api\Factory;

use Virhi\RestApiDoctrineBundle\Api\Resources\ColumnRessource;
use Virhi\RestApiDoctrineBundle\Api\Resources\Context\Context;
use Virhi\RestApiDoctrineBundle\Api\Resources\Context\ColumnContext;

class ColumnResourceFactory extends ResourceFactory implements ResourceFactoryInterface
{
    /**
     * @param Context $context
     * @return ColumnRessource
     */
    static public function buildResource(Context $context)
    {
        if (! $context instanceof ColumnContext) {
            throw new \RuntimeException("Wrong context");
        }

        $resource = new ColumnRessource($context->getRouter(), $context->getColumn());
        return $resource;
    }
} 