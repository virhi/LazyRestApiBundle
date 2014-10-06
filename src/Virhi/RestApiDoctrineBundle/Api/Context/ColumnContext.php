<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 16:32
 */

namespace Virhi\RestApiDoctrineBundle\Api\Context;

use Doctrine\DBAL\Schema\Column;
use Symfony\Component\Routing\RouterInterface;

class ColumnContext extends Context
{
    /**
     * @var Column
     */
    protected $column;

    function __construct(Column $column, RouterInterface $router)
    {
        $this->column = $column;
        parent::__construct($router);
    }

    /**
     * @return Column
     */
    public function getColumn()
    {
        return $this->column;
    }
}