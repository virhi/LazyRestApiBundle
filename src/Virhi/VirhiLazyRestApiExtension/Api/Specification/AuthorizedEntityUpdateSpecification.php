<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/12/14
 * Time: 15:48
 */

namespace Virhi\LazyRestApiBundle\Api\Specification;


class AuthorizedEntityUpdateSpecification extends AbstractAuthorizedEntityActionSpecification
{
    function __construct(array $authorizedEntities = array())
    {
        $this->authorizedEntities = $authorizedEntities;
        $this->action = 'edit_mode';
    }
} 