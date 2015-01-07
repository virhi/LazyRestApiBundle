<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 08/12/2014
 * Time: 19:29
 */

namespace Virhi\LazyRestApiBundle\Api\Command;

use Virhi\Component\Command\CommandInterface;
use Virhi\Component\Command\Context\ContextInterface;
use Virhi\Component\Repository\RemoverInterface;
use Virhi\LazyRestApiBundle\Api\Command\Context\RemoveContext;
use Virhi\LazyRestApiBundle\Api\Repository\Entity\Finder;
use Virhi\Component\Transformer\TransformerInterface;
use Doctrine\ORM\AbstractQuery;
use Virhi\LazyRestApiBundle\Api\Specification\AuthorizedEntityDeleteSpecification;

class RemoveCommand implements CommandInterface
{
    /**
     * @var RemoverInterface
     */
    protected $remover;

    /**
     * @var Finder
     */
    protected $finder;

    /**
     * @var TransformerInterface
     */
    protected $contextToSearchTransformer;

    /**
     * @var AuthorizedEntityDeleteSpecification
     */
    protected $authorizedEntityDeleteSpecification;

    function __construct(RemoverInterface $remover, Finder $finder, TransformerInterface $contextToSearchTransformer, AuthorizedEntityDeleteSpecification $authorizedEntityDeleteSpecification)
    {
        $this->remover = $remover;
        $this->finder  = $finder;
        $this->contextToSearchTransformer = $contextToSearchTransformer;
        $this->authorizedEntityDeleteSpecification = $authorizedEntityDeleteSpecification;
    }

    public function execute(ContextInterface $context)
    {
        if (!$context instanceof RemoveContext) {
            throw new \RuntimeException();
        }

        if (!$this->authorizedEntityDeleteSpecification->isSatisfiedBy($context->getObjectStructure()->getName())) {
            throw new \RuntimeException();
        }

        $search = $this->contextToSearchTransformer->transform($context);
        $search->setHydratation(AbstractQuery::HYDRATE_OBJECT);
        $entity = $this->finder->find($search);

        $this->remover->remove($entity);
    }

}