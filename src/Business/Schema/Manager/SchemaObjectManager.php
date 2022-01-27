<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Schema\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Schema\Manager\SchemaObjectManagerInterface;
use Micro\Plugin\Eav\Entity\Schema\SchemaInterface;

class SchemaObjectManager implements SchemaObjectManagerInterface
{

    public function __construct(private DoctrineFacadeInterface $doctrineFacade)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function save(SchemaInterface $schema): void
    {
        $manager = $this->getManager();
        $manager->persist($schema);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function saveBatch(iterable $schemaIterator): void
    {
        $manager = $this->getManager();
        foreach ($schemaIterator as $schema) {
            $manager->persist($schema);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function remove(SchemaInterface $schema): void
    {
        $manager = $this->getManager();
        $manager->remove($schema);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function removeBatch(iterable $schemaIterator): void
    {
        $manager = $this->getManager();
        foreach ($schemaIterator as $schema) {
            $manager->remove($schema);
        }

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
