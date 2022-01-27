<?php
declare(strict_types=1);

namespace Micro\Plugin\Eav\Doctrine;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Attribute\AttributeFactoryInterface;
use Micro\Plugin\Eav\Business\Entity\Manager\EntityObjectManagerFactoryInterface;
use Micro\Plugin\Eav\Business\Entity\Resolver\EntityResolverFactoryInterface;
use Micro\Plugin\Eav\Business\Schema\Manager\SchemaObjectManagerFactoryInterface;
use Micro\Plugin\Eav\Business\Schema\Resolver\SchemaResolverFactoryInterface;
use Micro\Plugin\Eav\Business\Schema\SchemaAttributeManagerFactoryInterface;
use Micro\Plugin\Eav\Doctrine\Business\Attribute\AttributeFactory;
use Micro\Plugin\Eav\Doctrine\Business\Entity\Manager\EntityObjectManagerFactory;
use Micro\Plugin\Eav\Doctrine\Business\Entity\Resolver\EntityResolverFactory;
use Micro\Plugin\Eav\Doctrine\Business\Schema\Manager\SchemaObjectManagerFactory;
use Micro\Plugin\Eav\Doctrine\Business\Schema\Resolver\SchemaResolverFactory;
use Micro\Plugin\Eav\Doctrine\Business\Schema\SchemaAttributeManagerFactory;
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
    protected function createSchemaResolverFactory(): SchemaResolverFactoryInterface
    {
        return new SchemaResolverFactory($this->lookupDoctrineFacade());
    }

    /**
     * {@inheritDoc}
     */
    protected function createSchemaAttributeManagerFactory(): SchemaAttributeManagerFactoryInterface
    {
        return new SchemaAttributeManagerFactory();
    }

    /**
     * {@inheritDoc}
     */
    protected function createSchemaObjectManagerFactory(): SchemaObjectManagerFactoryInterface
    {
        return new SchemaObjectManagerFactory($this->lookupDoctrineFacade());
    }

    /**
     * {@inheritDoc}
     */
    protected function createEntityObjectManagerFactory(): EntityObjectManagerFactoryInterface
    {
        return new EntityObjectManagerFactory($this->lookupDoctrineFacade());
    }

    /**
     * @return DoctrineFacadeInterface
     */
    protected function lookupDoctrineFacade(): DoctrineFacadeInterface
    {
        return $this->container->get(DoctrineFacadeInterface::class);
    }

    /**
     * {@inheritDoc}
     */
    protected function createEntityResolverFactory(): EntityResolverFactoryInterface
    {
        return new EntityResolverFactory($this->lookupDoctrineFacade());
    }
}
