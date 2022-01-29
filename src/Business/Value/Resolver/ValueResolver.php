<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Value\Resolver;

use Doctrine\Persistence\ObjectRepository;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Value\Resolver\ValueResolverInterface;
use Micro\Plugin\Eav\Doctrine\Business\Value\Type\ValueTypeResolverFactoryInterface;
use Micro\Plugin\Eav\Doctrine\Entity\Entity\Entity;
use Micro\Plugin\Eav\Entity\Attribute\AttributeInterface;
use Micro\Plugin\Eav\Entity\Entity\EntityInterface;
use Micro\Plugin\Eav\Entity\Value\ValueInterface;

class ValueResolver implements ValueResolverInterface
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     * @param ValueTypeResolverFactoryInterface $valueTypeResolverFactory
     */
    public function __construct(
        private DoctrineFacadeInterface $doctrineFacade,
        private ValueTypeResolverFactoryInterface $valueTypeResolverFactory
    ) {
    }

    /**
     * @param Entity $entity
     * @param AttributeInterface $attribute
     * @return ValueInterface
     */
    public function resolve(EntityInterface $entity, AttributeInterface $attribute): ValueInterface
    {
        $valueType = $this->resolveValueType($attribute);
        $valueRepository = $this->getValueRepository($valueType);
        $valueObject = $valueRepository->findOneBy([
            'entity'    => $entity,
            'attribute' => $attribute,
        ]);

        if ($valueObject) {
            return $valueObject;
        }

        return new $valueType($entity, $attribute);
    }

    /**
     * @param AttributeInterface $attribute
     *
     * @return ObjectRepository
     */
    protected function getValueRepository(string $valueObjectClass): ObjectRepository
    {
        return $this->doctrineFacade->getManager()->getRepository($valueObjectClass);
    }

    /**
     * @param AttributeInterface $attribute
     *
     * @return string
     */
    protected function resolveValueType(AttributeInterface $attribute): string
    {
        return $this->valueTypeResolverFactory->create()->resolve($attribute);
    }
}
