<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 23:47
 */

namespace Virhi\RestApiDoctrineBundle\Api\Resources;

use Symfony\Component\Routing\RouterInterface;
use Alterway\Bundle\RestHalBundle\ApiResource\Resource;

class ListEntityRessource extends Resource
{
    /**
     * @var array
     */
    protected $list;

    function __construct(RouterInterface $router, array $list = array())
    {
        parent::__construct($router);
        $this->list = $list;
    }

    protected function prepare()
    {
        foreach ($this->list as $entity) {
            $this->addResource('entitys', $entity);
        }
    }

    protected function generateUri()
    {
        return '';
    }


} 