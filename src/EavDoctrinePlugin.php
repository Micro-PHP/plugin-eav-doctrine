<?php

namespace Micro\Plugin\Eav\Doctrine;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Attribute\AttributeFactoryInterface;
use Micro\Plugin\Eav\Business\Entity\EntityManagerFactoryInterface;
use Micro\Plugin\Eav\Business\Schema\SchemaManagerFactoryInterface;
use Micro\Plugin\Eav\Doctrine\Business\Attribute\AttributeFactory;
use Micro\Plugin\Eav\Doctrine\Business\Entity\EntityManagerFactory;
use Micro\Plugin\Eav\Doctrine\Business\Schema\SchemaManagerFactory;
use Micro\Plugin\Eav\EavCorePlugin;

class EavDoctrinePlugin extends EavCorePlugin
{
    /**
     * {@inheritDoc}
     */
    protected function createAttributeFactory(): AttributeFactoryInterface
    {
        return new AttributeFactory();
    }

    /**
     * {@inheritDoc}
     */
    protected function createSchemaManagerFactory(): SchemaManagerFactoryInterface
    {
        return new SchemaManagerFactory($this->lookupDoctrineFacade());
    }

    /**
     * @return EntityManagerFactoryInterface
     */
    protected function createEntityManagerFactory(): EntityManagerFactoryInterface
    {
        return new EntityManagerFactory($this->lookupDoctrineFacade());
    }

    /**
     * @return DoctrineFacadeInterface
     */
    protected function lookupDoctrineFacade(): DoctrineFacadeInterface
    {
        return $this->container->get(DoctrineFacadeInterface::class);
    }
}
