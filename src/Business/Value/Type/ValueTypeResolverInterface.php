<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Attribute\Attribute;
use Micro\Plugin\Eav\Entity\Attribute\AttributeInterface;

interface ValueTypeResolverInterface
{
    /**
     * @param Attribute $attribute
     *
     * @return string
     */
    public function resolve(AttributeInterface $attribute): string;
}
