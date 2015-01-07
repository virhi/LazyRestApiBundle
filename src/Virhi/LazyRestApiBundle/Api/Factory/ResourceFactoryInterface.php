<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 16:20
 */

namespace Virhi\LazyRestApiBundle\Api\Factory;

use Virhi\LazyRestApiBundle\Api\Resources\Context\Context;

interface ResourceFactoryInterface
{
    /**
     * @param Context $context
     * @return Resource
     */
    static public function buildResource(Context $context);
} 