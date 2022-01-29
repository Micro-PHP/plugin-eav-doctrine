<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Value\Unique;

use Micro\Plugin\Eav\Business\Value\Unique\EntityAttributeUniqueGeneratorFactoryInterface;
use Micro\Plugin\Eav\Business\Value\Unique\EntityAttributeUniqueGeneratorInterface;

class EntityAttributeUniqueGeneratorFactory implements EntityAttributeUniqueGeneratorFactoryInterface
{
    /**
     * @return EntityAttributeUniqueGeneratorInterface
     */
    public function create(): EntityAttributeUniqueGeneratorInterface
    {
        return new EntityAttributeUniqueGenerator();
    }
}
