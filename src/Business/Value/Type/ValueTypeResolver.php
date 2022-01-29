<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Value\Type;

use Micro\Plugin\Eav\Entity\Attribute\AttributeInterface;

class ValueTypeResolver implements ValueTypeResolverInterface
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
    public function resolve(AttributeInterface $attribute): string
    {
        $valueType = $attribute->getType();

        foreach ($this->valueClassCollection as $class => $type) {
            if($type === $valueType) {
                return $class;
            }
        }

        throw new \RuntimeException(sprintf('Attribute type "%s" is not supported', $valueType));
    }
}
