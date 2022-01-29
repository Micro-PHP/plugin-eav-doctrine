<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Value\Resolver;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Value\Resolver\ValueResolverFactoryInterface;
use Micro\Plugin\Eav\Business\Value\Resolver\ValueResolverInterface;
use Micro\Plugin\Eav\Doctrine\Business\Value\Type\ValueTypeResolverFactoryInterface;

class ValueResolverFactory implements ValueResolverFactoryInterface
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     * @param ValueTypeResolverFactoryInterface $valueTypeResolverFactory
     */
    public function __construct(
        private DoctrineFacadeInterface $doctrineFacade,
        private ValueTypeResolverFactoryInterface $valueTypeResolverFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): ValueResolverInterface
    {
        return new ValueResolver(
            $this->doctrineFacade,
            $this->valueTypeResolverFactory
        );
    }
}
