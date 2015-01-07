<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 03/12/2014
 * Time: 21:30
 */

namespace Virhi\LazyRestApiBundle\Api\Transformer\ContextToSearch\Object;

use Virhi\Component\Transformer\TransformerInterface;
use Virhi\LazyRestApiBundle\Api\Query\Context\Object\ListObjectContext;
use Virhi\LazyRestApiBundle\Api\Search\ListObjectSearch;

class ListObjectTransformer implements TransformerInterface
{
    public function transform($context)
    {
        if (!$context instanceof ListObjectContext) {
            throw new \RuntimeException();
        }

        return new ListObjectSearch();
    }

} 