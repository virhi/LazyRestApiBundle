<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 23:47
 */

namespace Virhi\LazyRestApiBundle\Api\Resources;

use Symfony\Component\Routing\RouterInterface;
use Alterway\Bundle\RestHalBundle\ApiResource\Resource;
use Virhi\Component\Collection\MetaDataCollection;
use Virhi\LazyRestApiBundle\Api\Factory\EntityResourceFactory;
use Virhi\LazyRestApiBundle\Api\Resources\Context\EntityContext;

class ListEntityRessource extends Resource
{
    /**
     * @var MetaDataCollection
     */
    protected $list;

    function __construct(RouterInterface $router, MetaDataCollection $list )
    {
        parent::__construct($router);
        $this->list = $list;
    }

    protected function prepare()
    {
        $data = array(
            'total' => $this->list->getNbTotal()
        );
        
        $this->setData($data);

        foreach ($this->list->getList() as $entity) {
            $contextEntity = new EntityContext($entity, $this->router);
            $this->addResource('entitys', EntityResourceFactory::buildResource($contextEntity));
        }
    }

    protected function generateUri()
    {
        return '';
    }


} 