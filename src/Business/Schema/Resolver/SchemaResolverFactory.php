<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Schema\Resolver;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Schema\Resolver\SchemaResolverFactoryInterface;
use Micro\Plugin\Eav\Business\Schema\Resolver\SchemaResolverInterface;

class SchemaResolverFactory implements SchemaResolverFactoryInterface
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     */
    public function __construct(private DoctrineFacadeInterface $doctrineFacade)
    {}

    /**
     * {@inheritDoc}
     */
    public function create(): SchemaResolverInterface
    {
        return new SchemaResolver($this->doctrineFacade);
    }
}
