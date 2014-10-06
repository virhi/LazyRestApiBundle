<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 15:17
 */

namespace Virhi\RestApiDoctrineBundle\Api\Resources;

use Symfony\Component\Routing\RouterInterface;
use Alterway\Bundle\RestHalBundle\ApiResource\Resource;

class SchemaResource extends Resource
{
    /**
     * @var array
     */
    protected $tables;

    function __construct(RouterInterface $router, array $tables = array())
    {
        parent::__construct($router);
        $this->tables = $tables;
    }

    protected function prepare()
    {
        $data = array();
        foreach ($this->tables as $tables) {
            $this->addResource('tables', $tables);
        }
        $this->setData($data);
    }

    protected function generateUri()
    {
        return ''; //$this->router->generate('virhi_symfony_application_post_all');
    }
} 