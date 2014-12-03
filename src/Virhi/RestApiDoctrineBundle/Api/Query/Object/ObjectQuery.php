<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:37
 */

namespace Virhi\RestApiDoctrineBundle\Api\Query\Object;

use Virhi\Component\Query\Context\ContextInterface;
use Virhi\Component\Query\QueryInterface;
use Virhi\Component\Transformer\TransformerInterface;
use Virhi\RestApiDoctrineBundle\Api\Service\ObjectService;

class ObjectQuery implements QueryInterface
{
    /**
     * @var ObjectService
     */
    protected $objectService;

    /**
     * @var TransformerInterface
     */
    protected $transformer;


    function __construct(ObjectService $objectService, TransformerInterface $transformer)
    {
        $this->objectService = $objectService;
        $this->transformer = $transformer;
    }


    public function execute(ContextInterface $context)
    {
        return $this->objectService->getObjectStructure($this->transformer->transform($context));
    }
} 