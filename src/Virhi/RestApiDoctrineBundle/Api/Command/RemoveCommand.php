<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 08/12/2014
 * Time: 19:29
 */

namespace Virhi\RestApiDoctrineBundle\Api\Command;

use Virhi\Component\Command\CommandInterface;
use Virhi\Component\Command\Context\ContextInterface;
use Virhi\Component\Repository\RemoverInterface;
use Virhi\RestApiDoctrineBundle\Api\Command\Context\RemoveContext;
use Virhi\RestApiDoctrineBundle\Api\Repository\Entity\Finder;
use Virhi\Component\Transformer\TransformerInterface;
use Doctrine\ORM\AbstractQuery;

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

    function __construct(RemoverInterface $remover, Finder $finder, TransformerInterface $contextToSearchTransformer)
    {
        $this->remover = $remover;
        $this->finder  = $finder;
        $this->contextToSearchTransformer = $contextToSearchTransformer;
    }

    public function execute(ContextInterface $context)
    {
        if (!$context instanceof RemoveContext) {
            throw new \RuntimeException();
        }

        $search = $this->contextToSearchTransformer->transform($context);
        $search->setHydratation(AbstractQuery::HYDRATE_OBJECT);
        $entity = $this->finder->find($search);

        $this->remover->remove($entity);
    }

}