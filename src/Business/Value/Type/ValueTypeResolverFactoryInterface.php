<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Value\Type;

interface ValueTypeResolverFactoryInterface
{
    /**
     * @return ValueTypeResolverInterface
     */
    public function create(): ValueTypeResolverInterface;
}
