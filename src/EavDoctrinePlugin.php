<?php
declare(strict_types=1);

namespace Micro\Plugin\Eav\Doctrine;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Attribute\AttributeFactoryInterface;
use Micro\Plugin\Eav\Business\Attribute\Resolver\EntityAttributeResolverFactoryInterface;
use Micro\Plugin\Eav\Business\Entity\Factory\EntityFactoryInterface;
use Micro\Plugin\Eav\Business\Entity\Manager\EntityObjectManagerFactoryInterface;
use Micro\Plugin\Eav\Business\Entity\Resolver\EntityResolverFactoryInterface;
use Micro\Plugin\Eav\Business\Schema\Factory\SchemaFactoryInterface;
use Micro\Plugin\Eav\Business\Schema\Manager\SchemaObjectManagerFactoryInterface;
use Micro\Plugin\Eav\Business\Schema\Resolver\SchemaResolverFactoryInterface;
use Micro\Plugin\Eav\Business\Schema\SchemaAttributeManagerFactoryInterface;
use Micro\Plugin\Eav\Business\Value\Get\ValueObjectGetFactoryInterface;
use Micro\Plugin\Eav\Business\Value\Resolver\ValueResolverFactoryInterface;
use Micro\Plugin\Eav\Business\Value\Set\ValueObjectSetFactoryInterface;
use Micro\Plugin\Eav\Business\Value\Typehint\Converter\BooleanTypehintConverter;
use Micro\Plugin\Eav\Business\Value\Typehint\Converter\DateTimeTypehintConverter;
use Micro\Plugin\Eav\Business\Value\Typehint\Converter\FloatTypehintConverter;
use Micro\Plugin\Eav\Business\Value\Typehint\Converter\IntegerTypehintConverter;
use Micro\Plugin\Eav\Business\Value\Typehint\Converter\StringTypehintConverter;
use Micro\Plugin\Eav\Business\Value\Unique\EntityAttributeUniqueGeneratorFactoryInterface;
use Micro\Plugin\Eav\Doctrine\Business\Attribute\AttributeFactory;
use Micro\Plugin\Eav\Doctrine\Business\Attribute\Resolver\EntityAttributeResolverFactory;
use Micro\Plugin\Eav\Doctrine\Business\Entity\Manager\EntityObjectManagerFactory;
use Micro\Plugin\Eav\Doctrine\Business\Entity\Resolver\EntityResolverFactory;
use Micro\Plugin\Eav\Doctrine\Business\Schema\Factory\SchemaFactory;
use Micro\Plugin\Eav\Doctrine\Business\Schema\Manager\SchemaObjectManagerFactory;
use Micro\Plugin\Eav\Doctrine\Business\Schema\Resolver\SchemaResolverFactory;
use Micro\Plugin\Eav\Doctrine\Business\Schema\SchemaAttributeManagerFactory;
use Micro\Plugin\Eav\Doctrine\Business\Value\Get\ValueObjectGetFactory;
use Micro\Plugin\Eav\Doctrine\Business\Value\Resolver\ValueResolverFactory;
use Micro\Plugin\Eav\Doctrine\Business\Value\Set\ValueObjectSetFactory;
use Micro\Plugin\Eav\Doctrine\Business\Value\Type\ValueTypeResolverFactory;
use Micro\Plugin\Eav\Doctrine\Business\Value\Type\ValueTypeResolverFactoryInterface;
use Micro\Plugin\Eav\Doctrine\Business\Value\Unique\EntityAttributeUniqueGeneratorFactory;
use Micro\Plugin\Eav\Doctrine\Entity\Factory\EntityFactory;
use Micro\Plugin\Eav\Doctrine\Entity\Value\Type\BooleanType;
use Micro\Plugin\Eav\Doctrine\Entity\Value\Type\DateTimeType;
use Micro\Plugin\Eav\Doctrine\Entity\Value\Type\DateType;
use Micro\Plugin\Eav\Doctrine\Entity\Value\Type\FloatType;
use Micro\Plugin\Eav\Doctrine\Entity\Value\Type\IntegerType;
use Micro\Plugin\Eav\Doctrine\Entity\Value\Type\StringType;
use Micro\Plugin\Eav\Doctrine\Entity\Value\Type\TextType;
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
    protected function createSchemaFactory(): SchemaFactoryInterface
    {
        return new SchemaFactory();
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

    /**
     * {@inheritDoc}
     */
    protected function createEntityFactory(): EntityFactoryInterface
    {
        return new EntityFactory();
    }

    /**
     * {@inheritDoc}
     */
    protected function createEntityAttributeResolverFactory(): EntityAttributeResolverFactoryInterface
    {
        return new EntityAttributeResolverFactory();
    }

    /**
     * @return ValueResolverFactoryInterface
     */
    protected function createValueResolverFactory(): ValueResolverFactoryInterface
    {
        return new ValueResolverFactory(
            $this->lookupDoctrineFacade(),
            $this->createValueTypeResolverFactory()
        );
    }

    /**
     * @return iterable
     */
    protected function getValueTypes(): iterable
    {
        return [
            BooleanType::class => BooleanTypehintConverter::VALUE_TYPE,
            IntegerType::class => IntegerTypehintConverter::VALUE_TYPE,
            FloatType::class => FloatTypehintConverter::VALUE_TYPE,
            StringType::class => StringTypehintConverter::VALUE_TYPE_STRING,
            TextType::class => StringTypehintConverter::VALUE_TYPE_STRING,
            DateType::class => DateTimeTypehintConverter::VALUE_TYPE_DATE,
            DateTimeType::class => DateTimeTypehintConverter::VALUE_TYPE_DATE
        ];
    }

    /**
     * @return ValueTypeResolverFactoryInterface
     */
    protected function createValueTypeResolverFactory(): ValueTypeResolverFactoryInterface
    {
        return new ValueTypeResolverFactory($this->getValueTypes());
    }

    /**
     * @return ValueObjectSetFactoryInterface
     */
    protected function createValueObjectSetFactory(): ValueObjectSetFactoryInterface
    {
        return new ValueObjectSetFactory();
    }

    /**
     * {@inheritDoc}
     */
    protected function createValueObjectGetFactory(): ValueObjectGetFactoryInterface
    {
        return new ValueObjectGetFactory(
            $this->createEntityAttributeResolverFactory(),
            $this->createValueResolverFactory()
        );
    }

    /**
     * @return EntityAttributeUniqueGeneratorFactoryInterface
     */
    protected function createEntityAttributeUniqueGeneratorFactory(): EntityAttributeUniqueGeneratorFactoryInterface
    {
        return new EntityAttributeUniqueGeneratorFactory();
    }
}
