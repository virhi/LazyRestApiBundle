<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 20/12/2014
 * Time: 00:55
 */

namespace Virhi\RestApiDoctrineBundle\Tests\Api\Factory;

use Virhi\RestApiDoctrineBundle\Api\Factory\ObjectStructureFactory;


use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Types\TextType;

class ObjectStructureFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildObjectStructure()
    {
        $doctrine = $this->getMockBuilder('\Symfony\Bridge\Doctrine\RegistryInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $metadata = $this->getMockBuilder('\Doctrine\ORM\Mapping\ClassMetadata')
            ->disableOriginalConstructor()
            ->setMethods(array('getAssociationMappings'))
            ->getMock();

        $rawField = array(
            'columnName' => 'name',
            'fieldName'  => 'name',
        );

        $metadata->fieldMappings = array($rawField);

        $metadata->expects($this->once())
            ->method('getAssociationMappings')
            ->will($this->returnValue(array()));

        $table = $this->getMockBuilder('\Doctrine\DBAL\Schema\Table')
            ->disableOriginalConstructor()
            ->setMethods(array('getColumn'))
            ->getMock();

        $columnName = new Column('name', TextType::getType('text'));

        $columnName->setAutoincrement(false);
        $columnName->setLength(10);
        $columnName->setComment('comment');
        $columnName->setColumnDefinition('def');
        $columnName->setNotnull(true);

        $table->expects($this->at(0))
            ->method('getColumn')
            ->will($this->returnValue($columnName));

        $entity = array('name' => 'dummy');

        $actual = ObjectStructureFactory::buildObjectStructure($doctrine, $metadata, $table, $entity);
        $this->assertInstanceOf('\Virhi\RestApiDoctrineBundle\Api\ValueObject\ObjectStructure', $actual);
        $this->assertTrue($actual->hasField('name'));
        $this->assertEquals('dummy', $actual->getFields()->offsetGet('name')->getValue());
    }
} 