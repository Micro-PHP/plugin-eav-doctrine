<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Attribute\Resolver;

use Micro\Plugin\Eav\Business\Attribute\Resolver\EntityAttributeResolverInterface;
use Micro\Plugin\Eav\Doctrine\Entity\Entity\Entity;
use Micro\Plugin\Eav\Entity\Attribute\AttributeInterface;
use Micro\Plugin\Eav\Entity\Entity\EntityInterface;
use Micro\Plugin\Eav\Exception\AttributeNotFoundException;

class EntityAttributeResolver implements EntityAttributeResolverInterface
{
    /**
     * @param Entity $entity
     * @param string $attributeName
     *
     * @return AttributeInterface
     */
    public function resolve(EntityInterface $entity, string $attributeName): AttributeInterface
    {
        foreach ($this->list($entity) as $attribute) {
            if ($attributeName === $attribute->getName()) {
                return $attribute;
            }
        }

        throw new AttributeNotFoundException(sprintf(
            'Attribute "%s" is not declared in schema "%s"',
            $attributeName,
            $entity->getSchema()->getName()
        ));
    }

    /**
     * @param Entity $entity
     * @return iterable
     */
    public function list(EntityInterface $entity): iterable
    {
        return $entity->getSchema()->getAttributes();
    }
}
