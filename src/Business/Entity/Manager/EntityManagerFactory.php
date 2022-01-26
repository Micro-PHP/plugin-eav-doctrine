<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Entity\Manager;

use Doctrine\ORM\EntityManagerInterface as DoctrineEntityManager;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Entity\Manager\EntityManagerFactoryInterface;
use Micro\Plugin\Eav\Business\Entity\Manager\EntityManagerInterface;

class EntityManagerFactory implements EntityManagerFactoryInterface
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     */
    public function __construct(private DoctrineFacadeInterface $doctrineFacade)
    {}

    /**
     * {@inheritDoc}
     */
    public function create(): EntityManagerInterface
    {
        return new EntityManager($this->getOrmEntityManager());
    }

    /**
     * @return DoctrineEntityManager
     */
    protected function getOrmEntityManager(): DoctrineEntityManager
    {
        return $this->doctrineFacade->getManager();
    }
}
