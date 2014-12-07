<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 04/12/2014
 * Time: 00:02
 */

namespace Virhi\RestApiDoctrineBundle\Api\Command;

use Virhi\Component\Command\CommandInterface;
use Virhi\Component\Command\Context\ContextInterface;
use Virhi\Component\Repository\AttacherInterface;
use Virhi\RestApiDoctrineBundle\Api\Command\Context\Context;
use Virhi\RestApiDoctrineBundle\Api\Transformer\FormDataToEntity\EntityTransformer;

class UpdateCommand implements CommandInterface
{
    /**
     * @var AttacherInterface
     */
    protected $attacher;

    /**
     * @var EntityTransformer
     */
    protected $transformer;

    function __construct(AttacherInterface $attacher, EntityTransformer $transformer)
    {
        $this->attacher = $attacher;
        $this->transformer = $transformer;
    }

    public function execute(ContextInterface $context)
    {
        if (!$context instanceof Context) {
            throw new \RuntimeException();
        }

        $objToTransform = array(
            'name'        => $context->getName(),
            'imputEntity' => $context->getImputEntity(),
        );

        $entity = $this->transformer->transform($objToTransform);
        $this->attacher->attach($entity);
    }
}