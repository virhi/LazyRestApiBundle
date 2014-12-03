<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:37
 */

namespace Virhi\RestApiDoctrineBundle\Api\Query\Entity;

use Virhi\Component\Query\Context\ContextInterface;
use Virhi\Component\Query\QueryInterface;
use Virhi\Component\Transformer\TransformerInterface;
use Virhi\RestApiDoctrineBundle\Api\Service\EntityService;


class ListEntityQuery implements  QueryInterface
{
    /**
     * @var EntityService
     */
    protected $service;

    /**
     * @var TransformerInterface
     */
    protected $transformer;

    function __construct(EntityService $service, TransformerInterface $transformer)
    {
        $this->service     = $service;
        $this->transformer = $transformer;
    }


    public function execute(ContextInterface $context)
    {
        return $this->service->find($this->transformer->transform($context));
    }

} 