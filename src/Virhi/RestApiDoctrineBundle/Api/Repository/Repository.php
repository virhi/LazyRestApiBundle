<?php

namespace Virhi\RestApiDoctrineBundle\Api\Repository;

/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 22/10/2014
 * Time: 23:14
 */

use Virhi\Component\Repository\Repository as BaseRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

class Repository extends BaseRepository
{
    protected $manager;

    function __construct(RegistryInterface $doctrine, EntityManagerInterface $entiteManager, $manager)
    {
        parent::__construct($doctrine, $entiteManager);

        $this->manager = $manager;
    }
} 