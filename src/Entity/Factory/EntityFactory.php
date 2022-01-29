<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Factory;

use Micro\Plugin\Eav\Business\Entity\Factory\EntityFactoryInterface;
use Micro\Plugin\Eav\Doctrine\Entity\Entity\Entity;
use Micro\Plugin\Eav\Entity\Entity\EntityInterface;
use Micro\Plugin\Eav\Entity\Schema\SchemaInterface;

class EntityFactory implements EntityFactoryInterface
{
    /**
     * @param SchemaInterface $schema
     * @return EntityInterface
     */
    public function create(SchemaInterface $schema): EntityInterface
    {
        return new Entity($schema);
    }
}
