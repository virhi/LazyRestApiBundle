<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 20/12/2014
 * Time: 00:17
 */

namespace Virhi\RestApiDoctrineBundle\Tests\Api\Factory;

use Virhi\RestApiDoctrineBundle\Api\Factory\EntityFactory;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\ObjectStructure;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\Field;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\Embed;

class EntityFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testBuild()
    {
        $field = new Field();
        $field->setName('tutu');

        $embed = new Embed('embed', 'entity');

        $objectStructure = new ObjectStructure('toto', 'toto');
        $objectStructure->addField($field);
       // $objectStructure->addEmbeded($embed);

        $entity = array(
            'tutu'  => 'dummy',
            'embed' => 'dummyer'
        );

        $actual = EntityFactory::build($objectStructure, $entity);
        $this->assertInstanceOf('\Virhi\RestApiDoctrineBundle\Api\ValueObject\ObjectStructure', $actual);

        $this->assertCount(1, $actual->getFields());
        $this->assertTrue( $actual->hasField('tutu'));
        $this->assertEquals('dummy', $actual->getFields()->offsetGet('tutu')->getValue());

        //$this->assertCount(1, $actual->getEmbeded());
    }
} 