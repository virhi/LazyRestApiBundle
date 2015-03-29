<?php

namespace Virhi\LazyRestApiBundle\Api\Repository;

/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 22/10/2014
 * Time: 23:14
 */

use Virhi\Component\Repository\ORM\Repository as BaseRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\QueryBuilder;

class Repository extends BaseRepository
{
    protected $manager;

    function __construct(RegistryInterface $doctrine, EntityManagerInterface $entiteManager, $manager)
    {
        parent::__construct($doctrine, $entiteManager);

        $this->manager = $manager;
    }

    /**
     * @return QueryBuilder
     */
    protected function createQueryBuilder()
    {
        return $this->getEntiteManager()->createQueryBuilder();
    }
} 