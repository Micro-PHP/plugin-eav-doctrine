<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Schema;


use Micro\Plugin\Eav\Business\Schema\SchemaAttributeManagerFactoryInterface;
use Micro\Plugin\Eav\Business\Schema\SchemaAttributeManagerInterface;

class SchemaAttributeManagerFactory implements SchemaAttributeManagerFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(): SchemaAttributeManagerInterface
    {
        return new SchemaAttributeManager();
    }
}
