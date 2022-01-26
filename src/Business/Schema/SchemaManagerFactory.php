<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Schema;

use Doctrine\ORM\EntityManagerInterface;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Schema\SchemaManagerFactoryInterface;
use Micro\Plugin\Eav\Business\Schema\SchemaManagerInterface;

class SchemaManagerFactory implements SchemaManagerFactoryInterface
{
    public function __construct(private DoctrineFacadeInterface $doctrineFacade)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): SchemaManagerInterface
    {
        return new SchemaManager($this->getManager());
    }

    /**
     * @TODO: Make configurable
     *
     * @return EntityManagerInterface
     */
    protected function getManager(): EntityManagerInterface
    {
        return $this->doctrineFacade->getManager();
    }
}
