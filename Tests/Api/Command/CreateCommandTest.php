<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 17/12/2014
 * Time: 09:05
 */

namespace Virhi\LazyRestApiBundle\Tests\Api\Command;

use Virhi\LazyRestApiBundle\Api\Command\CreateCommand;
use Virhi\LazyRestApiBundle\Api\Command\Context\Context;

class CreateCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $attacher = $this->getMockBuilder('\Virhi\Component\Repository\ORM\Attacher')
            ->disableOriginalConstructor()
            ->setMethods(array('attach'))
            ->getMock();

        $attacher->expects($this->once())
            ->method('attach')
            ->will($this->returnValue(null));

        $entityNamespaceService = $this->getMockBuilder('\Virhi\LazyRestApiBundle\Api\Service\EntityNamespaceService')
            ->disableOriginalConstructor()
            ->setMethods(array('getEntityFullName'))
            ->getMock();

        $entityNamespaceService->expects($this->once())
            ->method('getEntityFullName')
            ->will($this->returnValue('\stdClass'));

        $transformer = $this->getMockBuilder('\Virhi\LazyRestApiBundle\Api\Transformer\FormDataToEntity\EntityTransformer')
            ->disableOriginalConstructor()
            ->setMethods(array('transform'))
            ->getMock();

        $transformer->expects($this->once())
            ->method('transform')
            ->will($this->returnValue(null));

        $specification = $this->getMockBuilder('\Virhi\LazyRestApiBundle\Api\Specification\AuthorizedEntityCreationSpecification')
            ->disableOriginalConstructor()
            ->setMethods(array('isSatisfiedBy'))
            ->getMock();

        $specification->expects($this->once())
            ->method('isSatisfiedBy')
            ->will($this->returnValue(true));


        $context = new Context('toto', array());
        $command = new CreateCommand($attacher, $entityNamespaceService, $transformer, $specification);
        $command->execute($context);
    }
} 