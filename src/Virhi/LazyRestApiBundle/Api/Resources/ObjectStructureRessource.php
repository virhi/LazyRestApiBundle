<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 01/11/2014
 * Time: 22:54
 */

namespace Virhi\LazyRestApiBundle\Api\Resources;

use Symfony\Component\Routing\RouterInterface;
use Alterway\Bundle\RestHalBundle\ApiResource\Resource;
use Virhi\LazyRestApiBundle\Api\ValueObject\ObjectStructure;
use Virhi\LazyRestApiBundle\Api\ValueObject\Field;
use Virhi\LazyRestApiBundle\Api\ValueObject\Embed;

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

        $data['name']       = $this->objectStructure->getName();
        $data['identifier'] = $this->objectStructure->getIdentifier();
        $data['fields']     = $this->buildFields($this->objectStructure->getFields());
        $data['embeds']     = $this->buildEmbed($this->objectStructure->getEmbeded());

        $this->setData($data);

        $this->generateUri();
    }

    protected function buildEmbed($embeds)
    {
        $result = array();
        foreach ($embeds as $embed) {

            foreach ($embed as $embeded) {
                if ($embeded instanceof Embed) {

                    $tmpEmbed = array();
                    $tmpEmbed['fieldName'] = $embeded->getFieldName();
                    $tmpEmbed['entityName'] = $embeded->getEntityName();
                    $entities = array();

                    foreach ($embeded->getListObjectStructure() as $index => $objectStructure) {

                        $entities[$index]['name']       = $objectStructure->getName();
                        $entities[$index]['identifier'] = $objectStructure->getIdentifier();
                        $entities[$index]['fields']     = $this->buildFields($objectStructure->getFields());
                        $entities[$index]['embeds']     = $this->buildEmbed($objectStructure->getEmbeded());
                    }

                    $tmpEmbed['entities']  = $entities;
                    $result[$embeded->getFieldName()][] = $tmpEmbed;
                }
            }
        }
        return $result;
    }

    protected function buildFields($fields)
    {
        $result = array();
        foreach ($fields as $field) {
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
                $result[] = $tmpField;
            }
        }
        return $result;
    }

    protected function generateUri()
    {

        return ''; //$this->router->generate('virhi_symfony_application_post_all');
    }
} 