<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Schema;

use ArrayAccess;
use Micro\Plugin\Eav\Business\Schema\SchemaAttributeManagerInterface;
use Micro\Plugin\Eav\Entity\Attribute\AttributeInterface;
use Micro\Plugin\Eav\Entity\Schema\SchemaInterface;
use Micro\Plugin\Eav\Exception\AttributeNotFoundException;


class SchemaAttributeManager implements SchemaAttributeManagerInterface
{
    /**
     * {@inheritDoc}
     */
    public function addAttribute(SchemaInterface $schema, AttributeInterface $attribute): SchemaAttributeManagerInterface
    {
        $schema->getAttributes()->add($attribute);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setAttributes(SchemaInterface $schema, ArrayAccess $attributes): SchemaAttributeManagerInterface
    {
        $schema->setAttributes($attributes);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getAttributes(SchemaInterface $schema): ArrayAccess
    {
        return $schema->getAttributes();
    }

    /**
     * {@inheritDoc}
     */
    public function getAttribute(SchemaInterface $schema, string $attributeName): AttributeInterface
    {
        foreach ($schema->getAttributes() as $attribute) {
            if($attribute->getName() === $attributeName) {
                return $attribute;
            }
        }

        throw new AttributeNotFoundException($attributeName);
    }
}
