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

use Virhi\RestApiDoctrineBundle\Api\Factory\TableResourceFactory;
use Virhi\RestApiDoctrineBundle\Api\Factory\SchemaResourceFactory;

use Virhi\RestApiDoctrineBundle\Api\Query\Context\Object\ListObjectContext;
use Virhi\RestApiDoctrineBundle\Api\Query\Context\Object\ObjectContext;
use Virhi\RestApiDoctrineBundle\Api\Resources\Context\TableContext;
use Virhi\RestApiDoctrineBundle\Api\Resources\Context\SchemaContext;

class ObjectController extends Controller
{
    /**
     * @return HalResponse
     */
    public function listObjectAction()
    {
        $queryContext = new ListObjectContext();
        $query = $this->get('virhi_rest_api_doctrine.query.object.list_object');

        $tables = $query->execute($queryContext);

        $context    = new SchemaContext($tables, $this->get('router'));
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
        $queryContext = new ObjectContext($name);
        $query      = $this->get('virhi_rest_api_doctrine.query.object.object');
        $table      = $query->execute($queryContext);

        $context    = new TableContext($table, $this->get('router') );
        $resource   = TableResourceFactory::buildResource($context);

        $reponse    = new HalResponse($resource);
        return $reponse;
    }

}