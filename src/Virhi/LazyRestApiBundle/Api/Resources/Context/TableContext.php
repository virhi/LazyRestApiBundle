<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 16:32
 */

namespace Virhi\LazyRestApiBundle\Api\Resources\Context;

use Doctrine\DBAL\Schema\Table;
use Symfony\Component\Routing\RouterInterface;

class TableContext extends Context
{
    /**
     * @var Table
     */
    protected $table;

    function __construct(Table $table, RouterInterface $router)
    {
        $this->table = $table;
        parent::__construct($router);
    }

    /**
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }
}