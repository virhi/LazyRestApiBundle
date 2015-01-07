<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/12/14
 * Time: 15:38
 */

namespace Virhi\LazyRestApiBundle\Api\Specification;


class AuthorizedEntityCreationSpecification extends AbstractAuthorizedEntityActionSpecification
{
    function __construct(array $authorizedEntities = array())
    {
        $this->authorizedEntities = $authorizedEntities;
        $this->action = 'create_mode';
    }
} 