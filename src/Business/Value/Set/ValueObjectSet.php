<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Value\Set;

use Micro\Plugin\Eav\Business\Value\Set\ValueObjectSetInterface;
use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Micro\Plugin\Eav\Entity\Value\ValueInterface;
use Micro\Plugin\Eav\Exception\InvalidArgumentException;

class ValueObjectSet implements ValueObjectSetInterface
{
    /**
     * @param AbstractValue $valueObject
     * @param mixed $value
     *
     * @throws InvalidArgumentException
     *
     * @return ValueInterface
     */
    public function set(ValueInterface $valueObject, mixed $value): ValueInterface
    {
        $valueObject->setValue($value);

        return $valueObject;
    }
}
