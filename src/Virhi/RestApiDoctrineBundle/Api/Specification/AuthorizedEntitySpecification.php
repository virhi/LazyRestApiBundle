<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/12/14
 * Time: 13:06
 */

namespace Virhi\RestApiDoctrineBundle\Api\Specification;

use Virhi\Component\Specification\SpecificationInterface;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\ObjectStructure;

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
        if ($entity instanceof ObjectStructure && ( count($this->authorizedEntities) === 0 || in_array($entity->getName(), $this->authorizedEntities))) {
            $result = true;
        }

        return $result;
    }

} 