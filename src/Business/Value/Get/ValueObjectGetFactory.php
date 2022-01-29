<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Value\Get;

use Micro\Plugin\Eav\Business\Attribute\Resolver\EntityAttributeResolverFactoryInterface;
use Micro\Plugin\Eav\Business\Value\Get\ValueObjectGetFactoryInterface;
use Micro\Plugin\Eav\Business\Value\Get\ValueObjectGetInterface;
use Micro\Plugin\Eav\Business\Value\Resolver\ValueResolverFactoryInterface;
use Micro\Plugin\Eav\Entity\Entity\EntityInterface;

class ValueObjectGetFactory implements ValueObjectGetFactoryInterface
{
    /**
     * @param EntityAttributeResolverFactoryInterface $entityAttributeResolverFactory
     * @param ValueResolverFactoryInterface $valueResolverFactory
     */
    public function __construct(
        private EntityAttributeResolverFactoryInterface $entityAttributeResolverFactory,
        private ValueResolverFactoryInterface $valueResolverFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(EntityInterface $entity, string $attributeName): ValueObjectGetInterface
    {
        return new ValueObjectGet(
            $this->entityAttributeResolverFactory,
            $this->valueResolverFactory,
            $entity,
            $attributeName
        );
    }
}
