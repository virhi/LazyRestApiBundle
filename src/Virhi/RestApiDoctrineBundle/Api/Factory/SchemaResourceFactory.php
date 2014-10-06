<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 16:21
 */

namespace Virhi\RestApiDoctrineBundle\Api\Factory;

use Virhi\RestApiDoctrineBundle\Api\Resources\SchemaResource;
use Virhi\RestApiDoctrineBundle\Api\Context\Context;
use Virhi\RestApiDoctrineBundle\Api\Context\SchemaContext;
use Virhi\RestApiDoctrineBundle\Api\Context\TableContext;

class SchemaResourceFactory extends ResourceFactory implements ResourceFactoryInterface
{
    /**
     * @param Context $context
     * @return SchemaResource
     */
    static public function buildResource(Context $context)
    {
        if (! $context instanceof SchemaContext) {
            throw new \RuntimeException("Wrong context");
        }

        $tablesResource = array();
        foreach ($context->getTables() as $table) {
            $tableContext    = new TableContext($table, $context->getRouter());
            $tablesResource[] = TableResourceFactory::buildResource($tableContext);
        }

        $resource = new SchemaResource($context->getRouter(), $tablesResource);
        return $resource;
    }
} 