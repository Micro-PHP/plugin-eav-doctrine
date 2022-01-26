<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Attribute;

use Micro\Plugin\Eav\Business\Attribute\AttributeFactoryInterface;
use Micro\Plugin\Eav\Doctrine\Entity\Attribute\Attribute;
use Micro\Plugin\Eav\Entity\Attribute\AttributeInterface;
use Micro\Plugin\Eav\Entity\Schema\SchemaInterface;

class AttributeFactory implements AttributeFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(SchemaInterface $schema, string $name, string $type): AttributeInterface
    {
        return new Attribute($schema, $name, $type);
    }
}
