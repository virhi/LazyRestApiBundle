<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 23:48
 */

namespace Virhi\RestApiDoctrineBundle\Api\Resources\Context;

use Symfony\Component\Routing\RouterInterface;

class ListEntityContext extends Context
{
    protected $list;

    function __construct($list, RouterInterface $router)
    {
        $this->list = $list;
        parent::__construct($router);
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        return $this->list;
    }
}