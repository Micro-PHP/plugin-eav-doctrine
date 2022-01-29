<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Attribute\Resolver;


use Micro\Plugin\Eav\Business\Attribute\Resolver\EntityAttributeResolverFactoryInterface;
use Micro\Plugin\Eav\Business\Attribute\Resolver\EntityAttributeResolverInterface;

class EntityAttributeResolverFactory implements EntityAttributeResolverFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(): EntityAttributeResolverInterface
    {
        return new EntityAttributeResolver();
    }
}
