<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Value\Type;

class ValueTypeResolverFactory implements ValueTypeResolverFactoryInterface
{
    /**
     * @param iterable<string, string> $valueClassCollection
     */
    public function __construct(private iterable $valueClassCollection)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): ValueTypeResolverInterface
    {
        return new ValueTypeResolver($this->valueClassCollection);
    }
}
