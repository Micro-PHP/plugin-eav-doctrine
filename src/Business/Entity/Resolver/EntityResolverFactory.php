<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Entity\Resolver;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Entity\Resolver\EntityResolverFactoryInterface;
use Micro\Plugin\Eav\Business\Entity\Resolver\EntityResolverInterface;

class EntityResolverFactory implements EntityResolverFactoryInterface
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     */
    public function __construct(private DoctrineFacadeInterface $doctrineFacade)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): EntityResolverInterface
    {
        return new EntityResolver($this->doctrineFacade);
    }
}
