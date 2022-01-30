<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Doctrine\Entity\EavCoreModelTrait;
use Micro\Plugin\Eav\Doctrine\Entity\Schema\Schema;
use Micro\Plugin\Eav\Doctrine\Entity\Unique\UniqueIndex;
use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Micro\Plugin\Eav\Entity\Entity\EntityInterface;
use Micro\Plugin\Eav\Entity\Value\ValueInterface;

/**
 * @ORM\Table(name="micro_eav_entity", indexes={
 *      @ORM\Index(name="sch_idx", columns={"id", "schema_id"})
 * })
 * ORM\Entity(repositoryClass="Vaderlab\EAV\Core\Repository\EntityRepository")
 * @ORM\HasLifecycleCallbacks()
 */

#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_entity')]
#[ORM\Index(columns: ['id', 'schema_id'], name: 'entity_sch_idx')]
#[ORM\HasLifecycleCallbacks()]
class Entity implements EntityInterface
{
    use EavCoreModelTrait;

    /**
     * @var DateTimeInterface
     * @ORM\Column(
     *     name="created_at",
     *     type="datetime",
     *     nullable=false
     *     )
     */
    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false)]
    private DateTimeInterface $createdAt;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(
     *     name="updated_at",
     *     type="datetime",
     *     nullable=true
     *     )
     */
    #[ORM\Column(name: 'updated_at', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $updatedAt;

    /**
     * @var Schema
     * @ORM\ManyToOne(
     *     targetEntity="Schema",
     *     inversedBy="entities",
     *     fetch="EAGER",
     *     cascade={"persist", "merge", "refresh"}
     *     )
     * @ORM\JoinColumn(name="schema_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    #[ORM\ManyToOne(targetEntity: Schema::class, cascade: ['persist', 'merge', 'refresh'], fetch: 'EAGER', inversedBy: 'entities')]
    #[ORM\JoinColumn(name: 'schema_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private Schema $schema;

    protected Collection $values;

    /**
     * @var ArrayCollection<UniqueIndex>
     * @ORM\OneToMany(
     *     targetEntity="UniqueIndex",
     *     mappedBy="entity",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=false
     * )
     * ORM\JoinColumn(name="id", referencedColumnName="entity_id", nullable=false, onDelete="CASCADE")
     */
    #[ORM\OneToMany(mappedBy: 'entity', targetEntity: UniqueIndex::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'entity_id', nullable: false, onDelete: 'CASCADE')]
    private Collection $uniqueIndexes;

    /**
     * Model constructor.
     */
    public function __construct(Schema $schema)
    {
        $this->values = new ArrayCollection([]);
        $this->uniqueIndexes = new ArrayCollection([]);
        $this->schema = $schema;
    }

    /**
     * @ORM\PrePersist()
     */
    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @return Schema
     */
    public function getSchema(): Schema
    {
        return $this->schema;
    }

    /**
     * @return Collection<ValueInterface>
     */
    public function getPersistentValues(): Collection
    {
        return $this->values;
    }

    /**
     * @param Collection $values
     * @return Entity
     */
    public function setPersistentValues(Collection $values): Entity
    {
        $this->values = $values;

        return $this;
    }

    /**
     * @return Collection<UniqueIndex>
     */
    public function getUniqueIndexes(): Collection
    {
        return $this->uniqueIndexes;
    }

    /**
     * @param ArrayCollection<UniqueIndex> $uniqueIndexes
     *
     * @return Entity
     */
    public function setUniqueIndexes(ArrayCollection $uniqueIndexes): self
    {
        $this->uniqueIndexes = $uniqueIndexes;

        return $this;
    }
}
