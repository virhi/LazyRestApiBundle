<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/10/2014
 * Time: 19:06
 */

namespace Virhi\RestApiDoctrineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Virhi\RestApiDoctrineBundle\Api\Command\Context\Context;

class WriteEntityController extends Controller
{
    public function createAction(Request $request, $name)
    {
        $statut = 200;
        try {
            $imputEntity = json_decode($request->getContent());

            $context = new Context($name, $imputEntity);
            $command = $this->get('virhi_rest_api_doctrine.command.create.entity');
            $command->execute($context);
        } catch (\Exception $e) {
            $statut = 500;
        }

        return new JsonResponse(array(), $statut);

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
        }

        return new JsonResponse(array(), $statut);
    }
} 