<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 23:48
 */

namespace Virhi\RestApiDoctrineBundle\Api\Resources\Context;

use Symfony\Component\Routing\RouterInterface;
use Virhi\Component\Collection\MetaDataCollection;

class ListEntityContext extends Context
{
    /**
     * @var MetaDataCollection
     */
    protected $list;

    function __construct(MetaDataCollection $list, RouterInterface $router)
    {
        $this->list = $list;
        parent::__construct($router);
    }

    /**
     * @return MetaDataCollection
     */
    public function getList()
    {
        return $this->list;
    }
}