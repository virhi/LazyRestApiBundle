<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 15:22
 */

namespace Virhi\RestApiDoctrineBundle\Api\Resources;

use Symfony\Component\Routing\RouterInterface;
use Alterway\Bundle\RestHalBundle\ApiResource\Resource;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Schema\Column;

class TableRessource extends Resource
{
    /**
     * @var Table
     */
    protected $table;

    /**
     * @var array
     */
    protected $collumns;

    function __construct(RouterInterface $router, Table $table, array $collumns = array())
    {
        parent::__construct($router);
        $this->table = $table;
        $this->collumns = $collumns;
    }

    protected function prepare()
    {
        $data = array();
        $data['name']        = $this->table->getName();
        $data['primary_key'] = $this->table->getPrimaryKey()->getName();

        foreach ($this->collumns as $collumn) {
            $this->addResource('collumns', $collumn);
        }

        $this->setData($data);
    }

    protected function generateUri()
    {
        return ''; //$this->router->generate('virhi_symfony_application_post_all');
    }
} 