<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 16:12
 */

namespace Virhi\LazyRestApiBundle\Api\Factory;

use Symfony\Component\Routing\RouterInterface;
use Alterway\Bundle\RestHalBundle\ApiResource\Resource;

abstract class ResourceFactory
{
    /**
     * @var
     */
    protected $router;

    function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
}