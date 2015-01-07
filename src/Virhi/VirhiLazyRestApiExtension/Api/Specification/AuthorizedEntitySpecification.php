<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/12/14
 * Time: 13:06
 */

namespace Virhi\LazyRestApiBundle\Api\Specification;

use Virhi\Component\Specification\SpecificationInterface;
use Virhi\LazyRestApiBundle\Api\ValueObject\ObjectStructure;

class AuthorizedEntitySpecification implements SpecificationInterface
{
    protected $authorizedEntities;

    function __construct(array $authorizedEntities = array())
    {
        $this->authorizedEntities = $authorizedEntities;
    }

    /**
     *
     * @return boolean
     */
    public function isSatisfiedBy($entity)
    {
        $result = false;
        if ($entity instanceof ObjectStructure) {
            if (count($this->authorizedEntities) > 0 ) {
                foreach ($this->authorizedEntities as $authorizedEntity) {
                    if ($entity->getName() === $authorizedEntity['entity_name']) {
                        $result = true;
                        break;
                    }
                }
            }
            elseif (count($this->authorizedEntities) === 0) {
                $result = true;
            }
        }
        return $result;
    }

} 