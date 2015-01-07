<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/10/2014
 * Time: 19:06
 */

namespace Virhi\LazyRestApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Virhi\LazyRestApiBundle\Api\Command\Context\Context;
use Virhi\LazyRestApiBundle\Api\Query\Context\Object\ObjectContext;
use Virhi\LazyRestApiBundle\Api\Command\Context\RemoveContext;

class WriteEntityController extends Controller
{
    public function createAction(Request $request, $name)
    {
        $statut = 200;
        $reponseData = array();
        try {
            $imputEntity = json_decode($request->getContent());

            $context = new Context($name, $imputEntity);
            $command = $this->get('virhi_rest_api_doctrine.command.create.entity');
            $command->execute($context);
        } catch (\Exception $e) {
            $statut = 500;
            $this->get('logger')->addError($e->getMessage());
            $reponseData['message'] =  $e->getMessage();
        }

        return new JsonResponse($reponseData, $statut);

    }

    public function updateAction(Request $request, $name, $id)
    {
        $statut = 200;
        try {
            $imputEntity = json_decode($request->getContent());

            $context = new Context($name, $imputEntity);
            $command = $this->get('virhi_rest_api_doctrine.command.update.entity');
            $command->execute($context);
        } catch (\Exception $e) {
            $statut = 500;
            $this->get('logger')->addError($e->getMessage());
        }

        return new JsonResponse(array(), $statut);
    }

    public function removeAction($name, $id)
    {
        $statut = 200;
        try {
            $queryObjectContext    = new ObjectContext($name);
            $queryObject           = $this->get('virhi_rest_api_doctrine.query.object.object');
            $objectStructure       = $queryObject->execute($queryObjectContext);
            $queryContext          = new RemoveContext($id, $name, $objectStructure);
            $command               = $this->get('virhi_rest_api_doctrine.command.remover.entity');

            $command->execute($queryContext);
        } catch (\Exception $e) {
            $statut = 500;
            $this->get('logger')->addError($e->getMessage());
        }

        return new JsonResponse(array(), $statut);
    }
} 