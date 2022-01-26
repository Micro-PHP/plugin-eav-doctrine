<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Entity\Manager;

use ArrayAccess;
use Micro\Plugin\Eav\Business\Entity\Manager\EntityManagerInterface;
use Micro\Plugin\Eav\Doctrine\Entity\Entity\Entity;
use Micro\Plugin\Eav\Doctrine\Entity\Schema\Schema;
use Micro\Plugin\Eav\Entity\Entity\EntityInterface;
use Doctrine\ORM\EntityManagerInterface as DoctrineEntityManager;
use Micro\Plugin\Eav\Entity\Schema\SchemaInterface;

class EntityManager implements EntityManagerInterface
{
    /**
     * @param DoctrineEntityManager $entityManager
     */
    public function __construct(private DoctrineEntityManager $entityManager)
    {
    }

    /**
     * @param Schema $schema
     *
     * @return EntityInterface
     */
    public function create(SchemaInterface $schema): EntityInterface
    {
        return new Entity($schema);
    }

    /**
     * @param Entity $entity
     *
     * @return EntityManagerInterface
     */
    public function delete(EntityInterface $entity): EntityManagerInterface
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();

        return $this;
    }

    /**
     * @param ArrayAccess<Entity> $entityCollection
     *
     * @return EntityManagerInterface
     */
    public function deleteBatch(ArrayAccess $entityCollection): EntityManagerInterface
    {
        foreach ($entityCollection as $entity) {
            $this->entityManager->remove($entity);
        }

        $this->entityManager->flush();

        return $this;
    }

    /**
     * @param Entity $entity
     *
     * @return EntityManagerInterface
     */
    public function save(EntityInterface $entity): EntityManagerInterface
    {
        $this->entityManager->persist($entity);

        $this->entityManager->flush();

        return $this;
    }

    /**
     * @param ArrayAccess<Entity> $entityCollection
     *
     * @return EntityManagerInterface
     */
    public function saveBatch(ArrayAccess $entityCollection): EntityManagerInterface
    {
        foreach ($entityCollection as $entity) {
            $this->entityManager->persist($entity);
        }

        $this->entityManager->flush();

        return $this;
    }
}
