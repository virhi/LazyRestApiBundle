<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 16:20
 */

namespace Virhi\RestApiDoctrineBundle\Api\Factory;

use Virhi\RestApiDoctrineBundle\Api\Context\Context;
use Alterway\Bundle\RestHalBundle\ApiResource\Resource;

interface ResourceFactoryInterface
{
    /**
     * @param Context $context
     * @return Resource
     */
    static public function buildResource(Context $context);
} 