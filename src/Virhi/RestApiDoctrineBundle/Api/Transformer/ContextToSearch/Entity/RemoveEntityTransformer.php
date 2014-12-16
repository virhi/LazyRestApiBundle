<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 16/12/2014
 * Time: 23:01
 */

namespace Virhi\RestApiDoctrineBundle\Api\Transformer\ContextToSearch\Entity;

use Virhi\RestApiDoctrineBundle\Api\Command\Context\RemoveContext;
use Virhi\RestApiDoctrineBundle\Api\Search\EntitySearch;

class RemoveEntityTransformer extends EntityTransformer
{

    /**
     * @param $context
     * @return EntitySearch
     */
    public function transform($context)
    {
        if (!$context instanceof RemoveContext) {
            throw new \RuntimeException();
        }

        return $this->execute($context);
    }
} 