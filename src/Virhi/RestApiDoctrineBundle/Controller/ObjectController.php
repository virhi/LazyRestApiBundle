<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 15:10
 */

namespace Virhi\RestApiDoctrineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Alterway\Bundle\RestHalBundle\Response\HalResponse;
use Symfony\Component\HttpFoundation\Request;

use Virhi\RestApiDoctrineBundle\Api\Factory\TableResourceFactory;
use Virhi\RestApiDoctrineBundle\Api\Factory\SchemaResourceFactory;
use Virhi\RestApiDoctrineBundle\Api\Context\TableContext;
use Virhi\RestApiDoctrineBundle\Api\Context\SchemaContext;

class ObjectController extends Controller
{
    /**
     * @return HalResponse
     */
    public function listObjectAction()
    {
        $doctrine   = $this->get("doctrine");
        $connection = $doctrine->getConnection();
        $sm         = $connection->getSchemaManager();

        $context    = new SchemaContext($sm->listTables(), $this->get('router'));
        $resource   = SchemaResourceFactory::buildResource($context);

        $reponse    = new HalResponse($resource);
        return $reponse;
    }

    /**
     * @param $name
     * @return HalResponse
     */
    public function objectAction($name)
    {
        $doctrine   = $this->get("doctrine");
        $connection = $doctrine->getConnection();
        $sm         = $connection->getSchemaManager();
        $table      = $sm->listTableDetails($name);
        $context    = new TableContext($table, $this->get('router') );
        $resource   = TableResourceFactory::buildResource($context);

        $reponse    = new HalResponse($resource);
        return $reponse;
    }

}