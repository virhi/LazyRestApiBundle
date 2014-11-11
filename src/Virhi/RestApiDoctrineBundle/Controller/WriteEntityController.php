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
use Virhi\RestApiDoctrineBundle\Api\Command\Context\Context;

class WriteEntityController extends Controller
{
    public function createAction(Request $request, $name)
    {
        $imputEntity = json_decode($request->getContent());

        $context = new Context($name, $imputEntity);
        $command = $this->get('virhi_rest_api_doctrine.command.create.entity');
        $command->execute($context);

        die('yooo');
    }

    public function updateAction(Request $request, $name)
    {
        $imputEntity = json_decode($request->getContent());

        $context = new Context($name, $imputEntity);
        $command = $this->get('virhi_rest_api_doctrine.command.create.entity');
        $command->execute($context);

        die('yooo');
    }
} 