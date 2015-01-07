<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 07/10/2014
 * Time: 16:38
 */

namespace Virhi\LazyRestApiBundle\Api\Query\Entity;

use Virhi\Component\Query\Context\ContextInterface;
use Virhi\Component\Transformer\TransformerInterface;
use Virhi\Component\Query\QueryInterface;
use Virhi\LazyRestApiBundle\Api\Service\EntityService;


class EntityQuery implements  QueryInterface
{
    /**
     * @var EntityService
     */
    protected $service;

    /**
     * @var TransformerInterface
     */
    protected $contextToSearchTransformer;

    /**
     * @var TransformerInterface
     */
    protected $entityTransformer;

    function __construct(EntityService $service, TransformerInterface $contextToSearchTransformer, TransformerInterface $entityTransformer)
    {
        $this->service = $service;
        $this->contextToSearchTransformer = $contextToSearchTransformer;
        $this->entityTransformer = $entityTransformer;
    }

    /**
     * @param ContextInterface $context
     * @return mixed
     */
    public function execute(ContextInterface $context)
    {
        $search = $this->contextToSearchTransformer->transform($context);
        $entity = $this->service->find($search);

        $obj = array(
            'search' => $search,
            'entity' => $entity,
        );

        return $this->entityTransformer->transform($obj);
    }

} 