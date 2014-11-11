<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/10/2014
 * Time: 19:27
 */

namespace Virhi\RestApiDoctrineBundle\Api\Service;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Mapping\DefaultEntityListenerResolver;

class EntityNamespaceService 
{
    /**
     * @var RegistryInterface
     */
    protected $doctrine;

    function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getEntityFullName($entityName)
    {
        $result = null;
        $em = $this->doctrine->getEntityManager();


        foreach ($em->getConfiguration()->getEntityNamespaces() as $namespace) {
            $tmpClass = '\\' . $namespace . '\\' . $entityName;
            if (class_exists($tmpClass)) {
                $result = $tmpClass;
            }
        }

        if ($result === null) {
            throw new \RuntimeException();
        }

        return $result;
    }
} 