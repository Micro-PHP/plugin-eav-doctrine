<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Schema\Resolver;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Schema\Resolver\SchemaResolverInterface;
use Micro\Plugin\Eav\Doctrine\Entity\Schema\Schema;
use Micro\Plugin\Eav\Entity\Schema\SchemaInterface;

class SchemaResolver implements SchemaResolverInterface
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     */
    public function __construct(private DoctrineFacadeInterface $doctrineFacade)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function resolve(string $schemaName): ?SchemaInterface
    {
        return $this->doctrineFacade
            ->getManager()
            ->getRepository(Schema::class)
            ->findOneBy(['name'  => $schemaName]);
    }

    /**
     * {@inheritDoc}
     */
    public function create(string $schemaName): SchemaInterface
    {
        return new Schema($schemaName);
    }
}
