<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Entity\Manager;


use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Entity\Manager\EntityObjectManagerFactoryInterface;
use Micro\Plugin\Eav\Business\Entity\Manager\EntityObjectManagerInterface;

class EntityObjectManagerFactory implements EntityObjectManagerFactoryInterface
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     */
    public function __construct(private DoctrineFacadeInterface $doctrineFacade)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): EntityObjectManagerInterface
    {
        return new EntityObjectManager($this->doctrineFacade);
    }
}
