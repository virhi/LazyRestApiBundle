<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 16:31
 */

namespace Virhi\RestApiDoctrineBundle\Api\Context;

use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\Routing\RouterInterface;

class SchemaContext extends Context
{
    /**
     * @var array
     */
    protected $tables;

    function __construct(array $tables, RouterInterface $router)
    {
        $this->tables = $tables;
        parent::__construct($router);
    }

    /**
     * @return array
     */
    public function getTables()
    {
        return $this->tables;
    }
}