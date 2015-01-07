<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 19/12/2014
 * Time: 19:06
 */

namespace Virhi\LazyRestApiBundle\Tests\Api\Command;

use Virhi\LazyRestApiBundle\Api\Command\RemoveCommand;
use Virhi\LazyRestApiBundle\Api\Command\Context\RemoveContext;
use Virhi\LazyRestApiBundle\Api\Command\Context\Context;
use Virhi\Component\Search\Search;
use Virhi\LazyRestApiBundle\Api\ValueObject\ObjectStructure;

class RemoveCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecuteWillThrowRuntimeException()
    {
        $this->setExpectedException('\RuntimeException');


        $finder = $this->getMockBuilder('\Virhi\LazyRestApiBundle\Api\Repository\Entity\Finder')
            ->disableOriginalConstructor()
            ->setMethods(array('find'))
            ->getMock();


        $transformer = $this->getMockBuilder('\Virhi\Component\Transformer\TransformerInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $remover = $this->getMockBuilder('\Virhi\Component\Repository\RemoverInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $specification = $this->getMockBuilder('\Virhi\LazyRestApiBundle\Api\Specification\AuthorizedEntityDeleteSpecification')
            ->disableOriginalConstructor()
            ->setMethods(array('isSatisfiedBy'))
            ->getMock();

        $context = new Context('toto', array());
        $command = new RemoveCommand($remover, $finder, $transformer, $specification);
        $command->execute($context);
    }

    public function testExecuteWillRemoveObject()
    {
        $finder = $this->getMockBuilder('\Virhi\LazyRestApiBundle\Api\Repository\Entity\Finder')
            ->disableOriginalConstructor()
            ->setMethods(array('find'))
            ->getMock();

        $finder->expects($this->once())
            ->method('find')
            ->will($this->returnValue('toto'));

        $transformer = $this->getMockBuilder('\Virhi\Component\Transformer\TransformerInterface')
            ->disableOriginalConstructor()
            ->setMethods(array('transform'))
            ->getMock();

        $transformer->expects($this->once())
            ->method('transform')
            ->will($this->returnValue(new Search()));

        $remover = $this->getMockBuilder('\Virhi\Component\Repository\RemoverInterface')
            ->disableOriginalConstructor()
            ->setMethods(array('remove', 'getDoctrine', 'getEntiteManager'))
            ->getMock();

        $remover->expects($this->once())
            ->method('remove')
            ->will($this->returnValue(null));

        $specification = $this->getMockBuilder('\Virhi\LazyRestApiBundle\Api\Specification\AuthorizedEntityDeleteSpecification')
            ->disableOriginalConstructor()
            ->setMethods(array('isSatisfiedBy'))
            ->getMock();

        $specification->expects($this->once())
            ->method('isSatisfiedBy')
            ->will($this->returnValue(true));

        $context = new RemoveContext(1, 'toto', new ObjectStructure('toto', 'tata'));
        $command = new RemoveCommand($remover, $finder, $transformer, $specification);
        $command->execute($context);
    }
} 