<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Value\Set;

use Micro\Plugin\Eav\Business\Value\Set\ValueObjectSetFactoryInterface;
use Micro\Plugin\Eav\Business\Value\Set\ValueObjectSetInterface;

class ValueObjectSetFactory implements ValueObjectSetFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(): ValueObjectSetInterface
    {
        return new ValueObjectSet();
    }
}
