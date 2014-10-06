<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 16:28
 */

namespace Virhi\RestApiDoctrineBundle\Api\Factory;

use Virhi\RestApiDoctrineBundle\Api\Resources\TableRessource;
use Virhi\RestApiDoctrineBundle\Api\Context\Context;
use Virhi\RestApiDoctrineBundle\Api\Context\TableContext;
use Virhi\RestApiDoctrineBundle\Api\Context\ColumnContext;

class TableResourceFactory extends ResourceFactory implements ResourceFactoryInterface
{
    /**
     * @param Context $context
     * @return Resource
     */
    static public function buildResource(Context $context)
    {
        if (! $context instanceof TableContext) {
            throw new \RuntimeException("Wrong context");
        }

        $columnResource = array();
        foreach ($context->getTable()->getColumns() as $column) {
            $columnContext    = new ColumnContext($column, $context->getRouter());
            $columnResource[] = ColumnResourceFactory::buildResource($columnContext);
        }

        $resource = new TableRessource($context->getRouter(), $context->getTable(), $columnResource);
        return $resource;
    }

} 