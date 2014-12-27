<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 03/12/2014
 * Time: 21:03
 */

namespace Virhi\RestApiDoctrineBundle\Api\Service;

use Virhi\Component\Search\SearchInterface;
use Virhi\Component\Repository\FinderInterface;
use Virhi\Component\Repository\ListFinderInterface;
use Virhi\Component\Transformer\TransformerInterface;

use Virhi\RestApiDoctrineBundle\Api\Repository\Entity\Finder;
use Virhi\RestApiDoctrineBundle\Api\Repository\Entity\ListFinder;
use Virhi\RestApiDoctrineBundle\Api\Repository\Entity\CountListFinder;
use Virhi\Component\Collection\MetaDataCollection;

class EntityService 
{
    /**
     * @var Finder
     */
    protected $finder;

    /**
     * @var ListFinder
     */
    protected $listFinder;

    /**
     * @var CountListFinder
     */
    protected $countListFinder;

    /**
     * @var TransformerInterface
     */
    protected $listEntityTransformer;



    function __construct(Finder $finder, ListFinder $listFinder, CountListFinder $countListFinder, TransformerInterface $listEntityTransformer)
    {
        $this->finder     = $finder;
        $this->listFinder = $listFinder;
        $this->countListFinder = $countListFinder;
        $this->listEntityTransformer = $listEntityTransformer;
    }


    public function find(SearchInterface $search)
    {
        return $this->finder->find($search);
    }

    /**
     * @param SearchInterface $search
     * @return MetaDataCollection
     */
    public function findList(SearchInterface $search)
    {
        $nb         = $this->countListFinder->find($search);
        $list       = $this->listFinder->find($search);

        $obj = array(
            'search'   => $search,
            'entities' => $list,
        );

        $collection = new MetaDataCollection($nb, $this->listEntityTransformer->transform($obj));

        return $collection;
    }
} 