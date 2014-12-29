<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/12/14
 * Time: 15:43
 */

namespace Virhi\RestApiDoctrineBundle\Api\Specification;


class AbstractAuthorizedEntityActionSpecification extends AuthorizedEntitySpecification
{

    protected $action;

    /**
     *
     * @return boolean
     */
    public function isSatisfiedBy($entity)
    {
        $result = false;
        if (count($this->authorizedEntities) > 0 ) {
            foreach ($this->authorizedEntities as $authorizedEntity) {
                if ($entity === '\\'.$authorizedEntity['entity_name'] && true === $authorizedEntity[$this->action]) {
                    $result = true;
                    break;
                }
            }
        }
        elseif (count($this->authorizedEntities) === 0) {
            $result = true;
        }

        return $result;
    }
} 