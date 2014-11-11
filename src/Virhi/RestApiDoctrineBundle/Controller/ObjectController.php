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
use Virhi\RestApiDoctrineBundle\Api\Resources\Context\ObjectStructureContext;
use Virhi\RestApiDoctrineBundle\Api\Resources\Context\SchemaContext;

use Virhi\RestApiDoctrineBundle\Api\Resources\ObjectStructureRessource;
use Virhi\RestApiDoctrineBundle\Api\Resources\ListObjectStructureRessource;

class ObjectController extends Controller
{
    /**
     * @return HalResponse
     */
    public function listObjectAction()
    {
        $queryContext     = new ListObjectContext();
        $query            = $this->get('virhi_rest_api_doctrine.query.object.list_object');
        $objectStructures = $query->execute($queryContext);

        $resource         = new ListObjectStructureRessource($this->get('router'), $objectStructures);
        $reponse          = new HalResponse($resource);
        return $reponse;
    }

    /**
     * @param $name
     * @return HalResponse
     */
    public function objectAction($name)
    {
        $queryContext    = new ObjectContext($name);
        $query           = $this->get('virhi_rest_api_doctrine.query.object.object');
        $objectStructure = $query->execute($queryContext);


        $resource   = new ObjectStructureRessource($this->get('router'), $objectStructure);
        $reponse    = new HalResponse($resource);
        return $reponse;
    }

}