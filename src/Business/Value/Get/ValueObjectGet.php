<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Value\Get;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Attribute\Resolver\EntityAttributeResolverFactoryInterface;
use Micro\Plugin\Eav\Business\Value\Get\ValueObjectGetInterface;
use Micro\Plugin\Eav\Business\Value\Resolver\ValueResolverFactoryInterface;
use Micro\Plugin\Eav\Entity\Attribute\AttributeInterface;
use Micro\Plugin\Eav\Entity\Entity\EntityInterface;
use Micro\Plugin\Eav\Entity\Value\ValueInterface;

class ValueObjectGet implements ValueObjectGetInterface
{
    /**
     * @param EntityAttributeResolverFactoryInterface $entityAttributeResolverFactory
     * @param ValueResolverFactoryInterface $valueResolverFactory
     * @param EntityInterface $entity
     * @param string $attributeName
     */
    public function __construct(
    private EntityAttributeResolverFactoryInterface $entityAttributeResolverFactory,
    private ValueResolverFactoryInterface $valueResolverFactory,
    private EntityInterface $entity,
    private string $attributeName
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function get(): ValueInterface
    {
        $attributeObject = $this->getAttribute();

        return $this->getValueObject($attributeObject);
    }

    /**
     * @return AttributeInterface
     */
    protected function getAttribute(): AttributeInterface
    {
        return $this->entityAttributeResolverFactory
            ->create()
            ->resolve($this->entity, $this->attributeName);
    }

    /**
     * @param AttributeInterface $attribute
     *
     * @return ValueInterface
     */
    protected function getValueObject(AttributeInterface $attribute): ValueInterface
    {
        return $this->valueResolverFactory
            ->create()
            ->resolve($this->entity, $attribute);
    }
}
