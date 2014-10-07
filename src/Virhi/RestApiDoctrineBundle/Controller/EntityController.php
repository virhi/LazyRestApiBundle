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
use Virhi\RestApiDoctrineBundle\Api\Context\ListEntityContext;
use Virhi\RestApiDoctrineBundle\Api\Context\EntityContext;
use Doctrine\ORM\AbstractQuery;

class EntityController extends Controller
{
    public function listEntityAction($name)
    {
        $doctrine = $this->get("doctrine");

        $qb = $doctrine->getEntityManager('default')->createQueryBuilder();
        $qb->select('x')
            ->from('VirhiSymfonyDomainBundle:' .ucfirst($name), 'x');

        $entitys = $qb->getQuery()->getArrayResult();

        $context  = new ListEntityContext($entitys, $this->get('router'));
        $resource = ListEntityResourceFactory::buildResource($context);
        $reponse  = new HalResponse($resource);
        return $reponse;
    }

    public function entityAction($name, $id)
    {
        $doctrine = $this->get("doctrine");

        $qb = $doctrine->getEntityManager('default')->createQueryBuilder();
        $qb->select('x')
            ->from('VirhiSymfonyDomainBundle:' .ucfirst($name), 'x')
            ->where('x.id = :id')
            ->setParameter('id', $id)
        ;

        $entity  = $qb->getQuery()->getSingleResult(AbstractQuery::HYDRATE_ARRAY);
        $context  = new EntityContext($entity, $this->get('router'));
        $resource = EntityResourceFactory::buildResource($context);
        $reponse  = new HalResponse($resource);
        return $reponse;
    }
}