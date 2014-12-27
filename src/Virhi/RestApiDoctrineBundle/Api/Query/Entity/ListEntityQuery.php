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
use Virhi\RestApiDoctrineBundle\Api\Factory\ObjectStructureFactory;

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

    protected $listEntityTransformer;

    function __construct(EntityService $service, TransformerInterface $transformer, TransformerInterface $listEntityTransformer)
    {
        $this->service     = $service;
        $this->transformer = $transformer;
        $this->listEntityTransformer = $listEntityTransformer;
    }

    /**
     * @param ContextInterface $context
     * @return mixed
     */
    public function execute(ContextInterface $context)
    {
        $search    = $this->transformer->transform($context);
        $entities  = $this->service->findList($search);

        return $entities;
    }

} 