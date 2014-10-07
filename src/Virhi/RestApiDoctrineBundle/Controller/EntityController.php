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

use Virhi\RestApiDoctrineBundle\Api\Resources\Context\ListEntityContext;
use Virhi\RestApiDoctrineBundle\Api\Resources\Context\EntityContext;

use Virhi\RestApiDoctrineBundle\Api\Query\Context\Entity\ListEntityContext as QueryListEntityContext;
use Virhi\RestApiDoctrineBundle\Api\Query\Context\Entity\EntityContext as QueryEntityContext;

class EntityController extends Controller
{
    public function listEntityAction($name)
    {
        $queryContext = new QueryListEntityContext($name);

        $query        = $this->get('virhi_rest_api_doctrine.query.entity.list_entity');
        $entitys      = $query->execute($queryContext);


        $context  = new ListEntityContext($entitys, $this->get('router'));
        $resource = ListEntityResourceFactory::buildResource($context);
        $reponse  = new HalResponse($resource);
        return $reponse;
    }

    public function entityAction($name, $id)
    {
        $queryContext = new QueryEntityContext($id, $name);
        $query = $this->get('virhi_rest_api_doctrine.query.entity.entity');

        $entity   = $query->execute($queryContext);

        $context  = new EntityContext($entity, $this->get('router'));
        $resource = EntityResourceFactory::buildResource($context);
        $reponse  = new HalResponse($resource);
        return $reponse;
    }
}