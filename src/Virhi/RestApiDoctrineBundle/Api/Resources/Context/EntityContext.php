<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 23:32
 */

namespace Virhi\RestApiDoctrineBundle\Api\Resources\Context;

use Symfony\Component\Routing\RouterInterface;

class EntityContext extends Context
{
    protected $entity;

    function __construct($entity, RouterInterface $router)
    {
        $this->entity = $entity;
        parent::__construct($router);
    }

    /**
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

} 