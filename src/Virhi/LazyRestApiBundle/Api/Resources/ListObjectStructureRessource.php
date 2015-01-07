<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 02/11/2014
 * Time: 16:50
 */

namespace Virhi\LazyRestApiBundle\Api\Resources;

use Symfony\Component\Routing\RouterInterface;
use Alterway\Bundle\RestHalBundle\ApiResource\Resource;

class ListObjectStructureRessource extends Resource
{
    /**
     * @var array
     */
    protected $objectStructures;

    function __construct(RouterInterface $router, array $objectStructures)
    {
        parent::__construct($router);
        $this->objectStructures = $objectStructures;
    }

    protected function prepare()
    {
        $data = array();

        foreach ($this->objectStructures as $objectStructure) {
            $res = new ObjectStructureRessource($this->router, $objectStructure);
            $this->addResource('tables', $res);
        }

        $this->setData($data);
    }

    protected function generateUri()
    {
        return ''; //$this->router->generate('virhi_symfony_application_post_all');
    }
} 