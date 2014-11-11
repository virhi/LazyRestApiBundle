<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 22:52
 */

namespace Virhi\RestApiDoctrineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Alterway\Bundle\RestHalBundle\Response\HalResponse;
use Virhi\RestApiDoctrineBundle\Api\Factory\ListEntityResourceFactory;
use Virhi\RestApiDoctrineBundle\Api\Factory\EntityResourceFactory;
use Virhi\RestApiDoctrineBundle\Api\Resources\ObjectStructureRessource;

use Virhi\RestApiDoctrineBundle\Api\Resources\Context\ListEntityContext;
use Virhi\RestApiDoctrineBundle\Api\Resources\Context\EntityContext;

use Virhi\RestApiDoctrineBundle\Api\Query\Context\Entity\ListEntityContext as QueryListEntityContext;
use Virhi\RestApiDoctrineBundle\Api\Query\Context\Entity\EntityContext as QueryEntityContext;
use Virhi\RestApiDoctrineBundle\Api\Query\Context\Object\ObjectContext;

class EntityController extends Controller
{
    public function listEntityAction($name)
    {
        $queryObjectContext    = new ObjectContext($name);
        $queryObject           = $this->get('virhi_rest_api_doctrine.query.object.object');
        $objectStructure       = $queryObject->execute($queryObjectContext);

        $queryContext = new QueryListEntityContext($name, $objectStructure);
        $query        = $this->get('virhi_rest_api_doctrine.query.entity.list_entity');
        $entitys      = $query->execute($queryContext);

        $context  = new ListEntityContext($entitys, $this->get('router'));
        $resource = ListEntityResourceFactory::buildResource($context);
        $reponse  = new HalResponse($resource);
        return $reponse;
    }

    public function entityAction($name, $id)
    {
        $queryObjectContext    = new ObjectContext($name);
        $queryObject           = $this->get('virhi_rest_api_doctrine.query.object.object');
        $objectStructure       = $queryObject->execute($queryObjectContext);

        $queryContext = new QueryEntityContext($id, $name, $objectStructure);
        $query        = $this->get('virhi_rest_api_doctrine.query.entity.entity');
        $entity       = $query->execute($queryContext);

        $context      = new EntityContext($entity, $this->get('router'));
        $resource     = EntityResourceFactory::buildResource($context);

        $reponse    = new HalResponse($resource);
        return $reponse;
    }
}