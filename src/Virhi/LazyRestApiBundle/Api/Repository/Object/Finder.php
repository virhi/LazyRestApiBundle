<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:00
 */

namespace Virhi\LazyRestApiBundle\Api\Repository\Object;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Virhi\Component\Repository\FinderInterface;
use Virhi\LazyRestApiBundle\Api\Factory\ObjectStructureFactory;
use Virhi\LazyRestApiBundle\Api\Repository\Repository as BaseRepository;
use Virhi\Component\Search\SearchInterface;
use Virhi\LazyRestApiBundle\Api\Search\ObjectSearch;
use Virhi\LazyRestApiBundle\Api\Specification\AuthorizedEntitySpecification;

class Finder extends BaseRepository implements FinderInterface
{
    /**
     * @var AuthorizedEntitySpecification
     */
    protected $authorizedEntitySpecification;

    function __construct(AuthorizedEntitySpecification $authorizedEntitySpecification, RegistryInterface $doctrine, EntityManagerInterface $entiteManager, $manager)
    {
        parent::__construct($doctrine, $entiteManager, $manager);
        $this->authorizedEntitySpecification = $authorizedEntitySpecification;
    }

    /**
     * @param SearchInterface $search
     * @return mixed
     */
    public function find(SearchInterface $search)
    {
        if (!$search instanceof ObjectSearch) {
            throw new \RuntimeException();
        }

        $table      = ObjectStructureFactory::getTables($this->getDoctrine(), $search->getName());
        $metadata   = ObjectStructureFactory::getEntityMetadata($this->getDoctrine(), $search->getNamespace());

        $objectStructure = ObjectStructureFactory::buildObjectStructure($this->getDoctrine(), $metadata, $table);

        if (!$this->authorizedEntitySpecification->isSatisfiedBy($objectStructure)) {
            throw new \RuntimeException('invalide entity');
        }

        return $objectStructure;
    }
}