<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 03/12/2014
 * Time: 23:49
 */

namespace Virhi\LazyRestApiBundle\Api\Transformer\Entity;

use Virhi\Component\Transformer\TransformerInterface;
use Virhi\LazyRestApiBundle\Api\Factory\ObjectStructureFactory;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ListEntityTransformer implements TransformerInterface
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
        $result     = array();
        $search     = $obj['search'];
        $entities   = $obj['entities'];
        $namespace  = $search->getNamespace() .'\\'.ucfirst($search->getName());

        foreach ($entities as $entity) {
            $table      = ObjectStructureFactory::getTables($this->getDoctrine(), $search->getName());
            $metadata   = ObjectStructureFactory::getEntityMetadata($this->getDoctrine(), $namespace);
            $result[]   = ObjectStructureFactory::buildObjectStructure($this->getDoctrine(), $metadata, $table, $entity);
        }

        return $result;
    }

    /**
     * @return RegistryInterface
     */
    public function getDoctrine()
    {
        return $this->doctrine;
    }
}