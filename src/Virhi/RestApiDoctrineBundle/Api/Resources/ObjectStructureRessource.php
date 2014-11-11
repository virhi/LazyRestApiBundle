<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 01/11/2014
 * Time: 22:54
 */

namespace Virhi\RestApiDoctrineBundle\Api\Resources;

use Symfony\Component\Routing\RouterInterface;
use Alterway\Bundle\RestHalBundle\ApiResource\Resource;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\ObjectStructure;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\Field;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\Embed;

class ObjectStructureRessource extends Resource
{
    /**
     * @var ObjectStructure
     */
    protected $objectStructure;

    function __construct(RouterInterface $router, ObjectStructure $objectStructure)
    {
        parent::__construct($router);
        $this->objectStructure = $objectStructure;
    }

    protected function prepare()
    {
        $data = array();

        $data['name'] = $this->objectStructure->getName();
        $data['identifier'] = $this->objectStructure->getIdentifier();

        foreach ($this->objectStructure->getFields() as $field) {
            if ($field instanceof Field) {
                $tmpField = array();
                $tmpField['name']           = $field->getName();
                $tmpField['value']          = $field->getValue();
                $tmpField['type']           = $field->getType();
                $tmpField['definition']     = $field->getDefinition();
                $tmpField['notnull']        = $field->getNotnull();
                $tmpField['length']         = $field->getLength();
                $tmpField['comment']        = $field->getComment();
                $tmpField['auto_increment'] = $field->getAutoIncrement();
                $data['fields'][] = $tmpField;
            }
        }

        foreach ($this->objectStructure->getEmbeded() as $embed) {
            if ($embed instanceof Embed) {
                $tmpEmbed = array();
                $tmpEmbed['name']       = $embed->getEntityName();
                $tmpEmbed['fieldName']  = $embed->getFieldName();
                $tmpEmbed['identifier'] = $embed->getIdentifiers();
                $tmpEmbed['value']      = $embed->getValue();

                $data['embeds'][$embed->getFieldName()][] = $tmpEmbed;
            }
        }

        $this->setData($data);
    }

    protected function generateUri()
    {
        return ''; //$this->router->generate('virhi_symfony_application_post_all');
    }
} 