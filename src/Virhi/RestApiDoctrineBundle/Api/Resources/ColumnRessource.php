<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 15:32
 */

namespace Virhi\RestApiDoctrineBundle\Api\Resources;

use Symfony\Component\Routing\RouterInterface;
use Alterway\Bundle\RestHalBundle\ApiResource\Resource;
use Doctrine\DBAL\Schema\Column;

class ColumnRessource extends Resource
{
    /**
     * @var Column
     */
    protected $column;

    function __construct(RouterInterface $router, Column $column)
    {
        parent::__construct($router);
        $this->column = $column;
    }

    protected function prepare()
    {
        $data = array();

        $data['name'] = $this->column->getName();
        $data['type'] = $this->column->getType()->getName();
        $data['definition'] = $this->column->getColumnDefinition();
        $data['notnull'] = $this->column->getNotnull();
        $data['length'] = $this->column->getLength();
        $data['comment'] = $this->column->getComment();
        $data['auto_increment'] = $this->column->getAutoincrement();

        $this->setData($data);
    }

    protected function generateUri()
    {
        return ''; //$this->router->generate('virhi_symfony_application_post_all');
    }
} 