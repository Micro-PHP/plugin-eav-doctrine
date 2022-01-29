<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Value\Unique;

use Micro\Plugin\Eav\Business\Value\Unique\EntityAttributeUniqueGeneratorInterface;
use Micro\Plugin\Eav\Doctrine\Entity\Attribute\Attribute;
use Micro\Plugin\Eav\Doctrine\Entity\Entity\Entity;
use Micro\Plugin\Eav\Doctrine\Entity\Unique\UniqueIndex;
use Micro\Plugin\Eav\Entity\Attribute\AttributeInterface;
use Micro\Plugin\Eav\Entity\Entity\EntityInterface;
use Micro\Plugin\Eav\Entity\Value\ValueInterface;

class EntityAttributeUniqueGenerator implements EntityAttributeUniqueGeneratorInterface
{
    /**
     * @param Entity $entity
     * @param Attribute $attribute
     * @param ValueInterface $value
     * @return void
     */
    public function generate(EntityInterface $entity, AttributeInterface $attribute, ValueInterface $value): void
    {
        $uniqueKeyString = $this->generateUniqueKey($entity, $attribute, $value);
        $entityUniqueIndexCollection = $entity->getUniqueIndexes();
        foreach ($entityUniqueIndexCollection as $index) {
            if($index->getAttribute()->getName() === $attribute->getName()) {
                $index->setUniqueKey($uniqueKeyString);

                return;
            }
        }

        $index = $this->createUniqueIndexEntity($entity, $attribute, $value);

        $entityUniqueIndexCollection->add($index);
    }

    /**
     * @param EntityInterface $entity
     * @param AttributeInterface $attribute
     * @param ValueInterface $value
     * @return string
     */
    protected function generateUniqueKey(EntityInterface $entity, AttributeInterface $attribute, ValueInterface $value): string
    {
        return sprintf('%s_%s_%s',
            get_class($entity),
            $attribute->getName(),
            $value->getValue()
        );
    }

    /**
     * @param EntityInterface $entity
     * @param AttributeInterface $attribute
     * @param string $uniqueKey
     * @return UniqueIndex
     */
    protected function createUniqueIndexEntity(EntityInterface $entity, AttributeInterface $attribute, string $uniqueKey): UniqueIndex
    {
        return new UniqueIndex($entity, $attribute, $uniqueKey);
    }
}
