<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Schema\Manager;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Schema\Manager\SchemaObjectManagerFactoryInterface;
use Micro\Plugin\Eav\Business\Schema\Manager\SchemaObjectManagerInterface;

class SchemaObjectManagerFactory implements SchemaObjectManagerFactoryInterface
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
    public function create(): SchemaObjectManagerInterface
    {
        return new SchemaObjectManager($this->doctrineFacade);
    }
}
