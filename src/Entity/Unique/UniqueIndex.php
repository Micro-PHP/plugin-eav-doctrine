<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Unique;

use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Doctrine\Entity\Attribute\Attribute;
use Micro\Plugin\Eav\Doctrine\Entity\EavCoreModelTrait;
use Micro\Plugin\Eav\Doctrine\Entity\Entity\Entity;
use Micro\Plugin\Eav\Entity\Unique\UniqueIndexInterface;

/**
 * @ORM\Table(name="micro_eav_unique_idx")
 * @ORM\Entity()
 */

#[ORM\Table(name: 'micro_eav_unique_idx')]
#[ORM\Entity]
class UniqueIndex implements UniqueIndexInterface
{
    use EavCoreModelTrait;

    /**
     * @var string
     * @ORM\Column(name="unique_key", unique=true, length=256, nullable=false)
     */
    #[ORM\Column(name: 'unique_key', length: 256, unique: true, nullable: false)]
    private string $uniqueKey;

    /**
     * @var Entity
     * @ORM\ManyToOne(targetEntity="Entity", fetch="LAZY", inversedBy="uniqueIndexes")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    #[ORM\ManyToOne(targetEntity: Entity::class, cascade: ['persist', 'merge'], fetch: 'LAZY', inversedBy: 'uniqueIndexes')]
    #[ORM\JoinColumn(name: 'entity_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private Entity $entity;

    /**
     * @var Attribute
     * @ORM\ManyToOne(targetEntity="Attribute", fetch="LAZY", inversedBy="uniqueIndexes", cascade={"persist", "merge"})
     * @ORM\JoinColumn(name="attribute_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    #[ORM\ManyToOne(targetEntity: Attribute::class, cascade: ['persist', 'merge'], fetch: 'LAZY', inversedBy: 'uniqueIndexes')]
    #[ORM\JoinColumn(name: 'attribute_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private Attribute $attribute;

    /**
     * @param Entity $entity
     * @param Attribute $attribute
     * @param string $uniqueKey
     */
    public function __construct(Entity $entity, Attribute $attribute, string $uniqueKey)
    {
        $this->entity = $entity;
        $this->attribute = $attribute;
        $this->uniqueKey = $uniqueKey;
    }

    /**
     * {@inheritDoc}
     */
    public function setUniqueKey(string $uniqueKey): self
    {
        $this->uniqueKey = $uniqueKey;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUniqueKey(): string
    {
        return $this->uniqueKey;
    }

    /**
     * @return Entity
     */
    public function getEntity(): Entity
    {
        return $this->entity;
    }

    /**
     * @param Entity $entity
     *
     * @return UniqueIndex
     */
    public function setEntity(Entity $entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * @return Attribute
     */
    public function getAttribute(): Attribute
    {
        return $this->attribute;
    }

    /**
     * @param Attribute $attribute
     *
     * @return UniqueIndex
     */
    public function setAttribute(Attribute $attribute): UniqueIndex
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getUniqueKey() ?: '';
    }
}
