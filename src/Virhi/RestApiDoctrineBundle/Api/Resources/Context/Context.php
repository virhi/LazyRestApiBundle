<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 16:17
 */

namespace Virhi\RestApiDoctrineBundle\Api\Resources\Context;

use Symfony\Component\Routing\RouterInterface;

class Context
{
    /**
     * @var RouterInterface
     */
    protected $router;

    function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @return RouterInterface
     */
    public function getRouter()
    {
        return $this->router;
    }
}