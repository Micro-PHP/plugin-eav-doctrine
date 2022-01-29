<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Schema\Factory;


use Micro\Plugin\Eav\Business\Schema\Factory\SchemaFactoryInterface;
use Micro\Plugin\Eav\Doctrine\Entity\Schema\Schema;
use Micro\Plugin\Eav\Entity\Schema\SchemaInterface;

class SchemaFactory implements SchemaFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(string $schemaName): SchemaInterface
    {
        return new Schema($schemaName);
    }
}
