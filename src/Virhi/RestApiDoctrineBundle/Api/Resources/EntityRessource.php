<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 23:32
 */

namespace Virhi\RestApiDoctrineBundle\Api\Resources;

use Symfony\Component\Routing\RouterInterface;
use Alterway\Bundle\RestHalBundle\ApiResource\Resource;

class EntityRessource extends Resource
{
    /**
     * @var array
     */
    protected $entity;

    function __construct(RouterInterface $router, array $entity = array())
    {
        parent::__construct($router);
        $this->entity = $entity;
    }

    protected function prepare()
    {
        $this->setData($this->entity);
    }

    protected function generateUri()
    {
        return '';
    }
}