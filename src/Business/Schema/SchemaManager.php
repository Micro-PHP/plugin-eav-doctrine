<?php

namespace Micro\Plugin\Eav\Doctrine\Business\Schema;

use ArrayAccess;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Micro\Plugin\Eav\Business\Schema\SchemaFactoryInterface;
use Micro\Plugin\Eav\Business\Schema\SchemaManagerInterface;
use Micro\Plugin\Eav\Doctrine\Entity\Attribute\Attribute;
use Micro\Plugin\Eav\Doctrine\Entity\Schema\Schema;
use Micro\Plugin\Eav\Entity\Attribute\AttributeInterface;
use Micro\Plugin\Eav\Entity\Schema\SchemaInterface;
use Micro\Plugin\Eav\Exception\AttributeNotFoundException;
use Micro\Plugin\Eav\Exception\SchemaNotFoundException;


class SchemaManager implements SchemaManagerInterface
{
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(private EntityManagerInterface $entityManager)
    {}

    /**
     * {@inheritDoc}
     */
    public function create(string $schemaName): SchemaInterface
    {
        $schema = new Schema($schemaName);

        $this->save($schema);

        return $schema;
    }

    /**
     * @param string $schemaName
     *
     * @return bool
     */
    public function exists(string $schemaName): bool
    {
        $isExists = false;

        try {
            $isExists = (bool)$this->findByName($schemaName);
        } catch (SchemaNotFoundException $exception) {
        }

        return $isExists;
    }

    /**
     * @param string $schemaName
     *
     * @throws SchemaNotFoundException
     *
     * @return Schema
     */
    public function findByName(string $schemaName): SchemaInterface
    {
        return $this->findSchemaBy([
            'name'  => $schemaName,
        ]);
    }

    /**
     * @param string $className
     *
     * @throws SchemaNotFoundException
     *
     * @return SchemaInterface
     */
    public function findByEntityClass(string $className): SchemaInterface
    {
        return $this->findSchemaBy([
            'entityClass'  => $className,
        ]);
    }

    /**
     * @param SchemaInterface $schema
     * @param Attribute $attribute
     * @return SchemaManagerInterface
     */
    public function addAttribute(SchemaInterface $schema, AttributeInterface $attribute): SchemaManagerInterface
    {
        $schema->getAttributes()->add($attribute);

        return $this;
    }

    /**
     * @param SchemaInterface $schema
     * @param ArrayCollection $attributes
     * @return SchemaManagerInterface
     */
    public function setAttributes(SchemaInterface $schema, ArrayAccess $attributes): SchemaManagerInterface
    {
        $schema->setAttributes($attributes);

        return $this;
    }

    /**
     * @param Schema $schema
     *
     * @return self
     */
    public function save(SchemaInterface $schema): self
    {
        $this->entityManager->persist($schema);
        $this->entityManager->flush();

        return $this;
    }

    /**
     * @return EntityRepository
     */
    protected function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Schema::class);
    }

    /**
     * @param array $criteria
     *
     * @throws SchemaNotFoundException
     *
     * @return Schema
     */
    protected function findSchemaBy(array $criteria): Schema
    {
        $result = $this->getRepository()->findOneBy($criteria);
        if($result === null) {
            throw new SchemaNotFoundException(sprintf('Schema is not found by criteria: %s', json_encode($criteria)));
        }

        return $result;
    }

    /**
     * @param Schema $schema
     *
     * @return ArrayAccess<AttributeInterface>
     */
    public function getAttributes(SchemaInterface $schema): ArrayAccess
    {
        return $schema->getAttributes();
    }

    /**
     * {@inheritDoc}
     */
    public function getAttribute(SchemaInterface $schema, string $attributeName): AttributeInterface
    {

        foreach ($schema->getAttributes() as $attribute) {
            if($attribute->getName() === $attributeName) {
                return $attribute;
            }
        }

        throw new AttributeNotFoundException($attributeName);
    }
}
