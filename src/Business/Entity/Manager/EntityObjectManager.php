<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Entity\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Entity\Manager\EntityObjectManagerInterface;
use Micro\Plugin\Eav\Entity\Entity\EntityInterface;

class EntityObjectManager implements EntityObjectManagerInterface
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
    public function save(EntityInterface $entity): void
    {
        $manager = $this->getManager();

        $manager->persist($entity);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function remove(EntityInterface $entity): void
    {
        $manager = $this->getManager();

        $manager->remove($entity);
        $manager->flush();
    }

    /**
     * @return EntityManagerInterface
     */
    protected function getManager(): EntityManagerInterface
    {
        return $this->doctrineFacade->getManager();
    }
}
