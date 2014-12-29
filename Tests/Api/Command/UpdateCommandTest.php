<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 19/12/2014
 * Time: 19:56
 */

namespace Virhi\RestApiDoctrineBundle\Tests\Api\Command;

use Virhi\RestApiDoctrineBundle\Api\Command\UpdateCommand;
use Virhi\RestApiDoctrineBundle\Api\Command\Context\Context;
use Virhi\Component\Search\Search;

class UpdateCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecuteWillThrowRuntimeException()
    {
        $this->setExpectedException('\RuntimeException');

        $context = $this->getMockBuilder('\Virhi\Component\Command\Context\ContextInterface')
            ->disableOriginalConstructor()
            ->setMethods(array('attach'))
            ->getMock();

        $attacher = $this->getMockBuilder('\Virhi\Component\Repository\Attacher')
            ->disableOriginalConstructor()
            ->getMock();

        $transformer = $this->getMockBuilder('\Virhi\RestApiDoctrineBundle\Api\Transformer\FormDataToEntity\EntityTransformer')
            ->disableOriginalConstructor()
            ->setMethods(array('transform'))
            ->getMock();

        $entityNamespaceService = $this->getMockBuilder('\Virhi\RestApiDoctrineBundle\Api\Service\EntityNamespaceService')
            ->disableOriginalConstructor()
            ->setMethods(array('getEntityFullName'))
            ->getMock();


        $specification = $this->getMockBuilder('\Virhi\RestApiDoctrineBundle\Api\Specification\AuthorizedEntityUpdateSpecification')
            ->disableOriginalConstructor()
            ->setMethods(array('isSatisfiedBy'))
            ->getMock();


        $command = new UpdateCommand($attacher, $transformer, $entityNamespaceService, $specification);
        $command->execute($context);
    }

    public function testExecute()
    {
        $attacher = $this->getMockBuilder('\Virhi\Component\Repository\Attacher')
            ->disableOriginalConstructor()
            ->setMethods(array('attach'))
            ->getMock();

        $attacher->expects($this->once())
            ->method('attach')
            ->will($this->returnValue(null));

        $transformer = $this->getMockBuilder('\Virhi\RestApiDoctrineBundle\Api\Transformer\FormDataToEntity\EntityTransformer')
            ->disableOriginalConstructor()
            ->setMethods(array('transform'))
            ->getMock();

        $transformer->expects($this->once())
            ->method('transform')
            ->will($this->returnValue(null));

        $entityNamespaceService = $this->getMockBuilder('\Virhi\RestApiDoctrineBundle\Api\Service\EntityNamespaceService')
            ->disableOriginalConstructor()
            ->setMethods(array('getEntityFullName'))
            ->getMock();

        $entityNamespaceService->expects($this->once())
            ->method('getEntityFullName')
            ->will($this->returnValue('\stdClass'));

        $specification = $this->getMockBuilder('\Virhi\RestApiDoctrineBundle\Api\Specification\AuthorizedEntityUpdateSpecification')
            ->disableOriginalConstructor()
            ->setMethods(array('isSatisfiedBy'))
            ->getMock();

        $specification->expects($this->once())
            ->method('isSatisfiedBy')
            ->will($this->returnValue(true));

        $context = new Context('toto', array());
        $command = new UpdateCommand($attacher, $transformer, $entityNamespaceService, $specification);
        $command->execute($context);
    }
} 