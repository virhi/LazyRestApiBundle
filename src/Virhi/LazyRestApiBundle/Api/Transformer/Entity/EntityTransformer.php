<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 03/12/2014
 * Time: 23:38
 */

namespace Virhi\LazyRestApiBundle\Api\Transformer\Entity;

use Virhi\Component\Transformer\TransformerInterface;
use Virhi\LazyRestApiBundle\Api\Factory\ObjectStructureFactory;
use Symfony\Bridge\Doctrine\RegistryInterface;

class EntityTransformer implements TransformerInterface
{
    /**
     * @var RegistryInterface
     */
    protected $doctrine;

    function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }


    public function transform($obj)
    {
        $search     = $obj['search'];
        $entity     = $obj['entity'];

        $namespace  = $search->getNamespace() .'\\'.ucfirst($search->getName());
        $table      = ObjectStructureFactory::getTables($this->getDoctrine(), $search->getName());
        $metadata   = ObjectStructureFactory::getEntityMetadata($this->getDoctrine(), $namespace);
        return ObjectStructureFactory::buildObjectStructure($this->getDoctrine(), $metadata, $table, $entity);
    }

    /**
     * @return RegistryInterface
     */
    public function getDoctrine()
    {
        return $this->doctrine;
    }


} 