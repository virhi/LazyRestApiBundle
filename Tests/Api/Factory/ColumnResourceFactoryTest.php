<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 19/12/2014
 * Time: 21:28
 */

namespace Virhi\RestApiDoctrineBundle\Tests\Api\Factory;

use Virhi\RestApiDoctrineBundle\Api\Factory\ColumnResourceFactory;
use Virhi\RestApiDoctrineBundle\Api\Resources\Context\ColumnContext;
use Doctrine\DBAL\Schema\Column;
use Virhi\RestApiDoctrineBundle\Api\Resources\Context\Context;

class ColumnResourceFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildResourceWillThrowExecption()
    {
        $this->setExpectedException('\RuntimeException');

        $context  = $this->getMockBuilder('\Virhi\RestApiDoctrineBundle\Api\Resources\Context\Context')
            ->disableOriginalConstructor()
            ->getMock();

        $ressource = ColumnResourceFactory::buildResource($context);
        $this->assertInstanceOf('\Virhi\RestApiDoctrineBundle\Api\Resources\ColumnRessource', $ressource);
    }

    public function testBuildResource()
    {
        $router  = $this->getMockBuilder('\Symfony\Component\Routing\RouterInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $column  = $this->getMockBuilder('\Doctrine\DBAL\Schema\Column')
            ->disableOriginalConstructor()
            ->getMock();

        $context = new ColumnContext($column, $router);

        $ressource = ColumnResourceFactory::buildResource($context);
        $this->assertInstanceOf('\Virhi\RestApiDoctrineBundle\Api\Resources\ColumnRessource', $ressource);
    }
} 