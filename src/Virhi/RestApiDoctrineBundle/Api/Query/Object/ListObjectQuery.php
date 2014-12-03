<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:35
 */

namespace Virhi\RestApiDoctrineBundle\Api\Query\Object;


use Virhi\Component\Query\Context\ContextInterface;
use Virhi\Component\Query\QueryInterface;
use Virhi\Component\Transformer\TransformerInterface;
use Virhi\RestApiDoctrineBundle\Api\Service\ObjectService;

class ListObjectQuery implements QueryInterface
{
    /**
     * @var ObjectService
     */
    protected $service;

    /**
     * @var TransformerInterface
     */
    protected $transformer;

    function __construct(ObjectService $service, TransformerInterface $transformer)
    {
        $this->service     = $service;
        $this->transformer = $transformer;
    }


    public function execute(ContextInterface $context)
    {
        return $this->service->getListObjectStructure($this->transformer->transform($context));
    }
} 