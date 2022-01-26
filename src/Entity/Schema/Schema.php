<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Schema;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Doctrine\Entity\Attribute\Attribute;
use Micro\Plugin\Eav\Doctrine\Entity\EavCoreModelTrait;
use Micro\Plugin\Eav\Doctrine\Entity\Entity\Entity;
use Micro\Plugin\Eav\Entity\Schema\SchemaInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="micro_eav_schema")
 */
#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_schema')]
class Schema implements SchemaInterface
{
    use EavCoreModelTrait;

    /**
     * @var string|null
     *
     * @ORM\Column(
     *     name="entity_class",
     *     type="string",
     *     length=150,
     *     nullable=true,
     *     unique=true
     * )
     */
    #[ORM\Column(name: 'entity_class', type: 'string', length: 150, unique: true, nullable: true)]
    private ?string $entityClass = null;

    /**
     * @var string
     *
     * @ORM\Column(
     *     name="name",
     *     type="string",
     *     length=50,
     *     nullable=false,
     *     unique=true
     *     )
     *
     * @Assert\Regex(
     *     match=true,
     *     pattern="/^[a-z0-9\-\_]+$/i",
     *     message="Schema name is not valid."
     * )
     */
    #[ORM\Column(name: 'name', type: 'string', length: 50, unique: true, nullable: false)]
    private string $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="Attribute",
     *     mappedBy="schema",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=false,
     *     cascade={"persist"}
     *     )
     *
     * @ORM\JoinColumn(name="id", referencedColumnName="schema_id", nullable=false, onDelete="CASCADE")
     */
    #[ORM\OneToMany(mappedBy: 'schema', targetEntity: Attribute::class, cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'schema_id', nullable: false, onDelete: 'CASCADE')]
    private \ArrayAccess $attributes;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="Entity",
     *     mappedBy="schema",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=false,
     *     cascade={"persist"}
     *     )
     *
     * @ORM\JoinColumn(name="id", referencedColumnName="schema_id", nullable=false, onDelete="CASCADE")
     */
    #[ORM\OneToMany(mappedBy: 'schema', targetEntity: Entity::class, cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'schema_id', nullable: false, onDelete: 'CASCADE')]
    private Collection $entities;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->attributes = new ArrayCollection([]);
        $this->entities = new ArrayCollection([]);

        $this->name = $name;
    }

    /**
     * {@inheritDoc}
     */
    public function setEntities(ArrayCollection $entities): Schema
    {
        $this->entities = $entities;

        return $this;
    }

    /**
     * @return ArrayCollection<Entity>
     */
    public function getEntities(): ArrayCollection
    {
        return $this->entities;
    }

    /**
     * @return ArrayCollection<Attribute>
     */
    public function getAttributes(): \ArrayAccess
    {
        return $this->attributes;
    }

    /**
     * @param Collection<Attribute> $attributes
     * @return $this
     */
    public function setAttributes(\ArrayAccess $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntityClass(): ?string
    {
        return $this->entityClass;
    }

    /**
     * @param string|null $entityClass
     * @return $this
     */
    public function setEntityClass(?string $entityClass): self
    {
        $this->entityClass = $entityClass;

        return $this;
    }
}
