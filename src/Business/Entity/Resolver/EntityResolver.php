<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Entity\Resolver;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Eav\Business\Entity\Resolver\EntityResolverInterface;
use Micro\Plugin\Eav\Doctrine\Entity\Entity\Entity;
use Micro\Plugin\Eav\Entity\Entity\EntityInterface;
use Micro\Plugin\Eav\Entity\Schema\SchemaInterface;

class EntityResolver implements EntityResolverInterface
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
    public function resolve(SchemaInterface $schema, string $id): EntityInterface
    {
        return $this->createQueryBuilder($schema)
            ->andWhere('e.id = :id')
            ->setParameter('id', (int)$id)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * {@inheritDoc}
     */
    public function resolveList(SchemaInterface $schema, int $count = null, string $offsetId = null): iterable
    {
        $qb = $this->createQueryBuilder($schema);

        if($offsetId !== null) {
            $qb
                ->andWhere('e.id >= :offset')
                ->setParameter('offset', (int)$offsetId);
        }

        if($count !== null) {
            $qb->setMaxResults($count);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function count(SchemaInterface $schema): int
    {
        return (int)$this->createQueryBuilder($schema)
            ->select('count(e.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @param SchemaInterface $schema
     *
     * @return QueryBuilder
     */
    protected function createQueryBuilder(SchemaInterface  $schema): QueryBuilder
    {
        return $this->getRepository()
            ->createQueryBuilder('e')
            ->andWhere('e.schema = :schema')
            ->setParameter('schema', $schema);
    }

    /**
     * @return EntityRepository
     */
    protected function getRepository(): EntityRepository
    {
        return $this->doctrineFacade->getManager()->getRepository(Entity::class);
    }
}
