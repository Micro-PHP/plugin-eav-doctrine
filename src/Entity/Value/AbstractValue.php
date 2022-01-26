<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Doctrine\Entity\Attribute\Attribute;
use Micro\Plugin\Eav\Doctrine\Entity\EavCoreModelTrait;
use Micro\Plugin\Eav\Doctrine\Entity\Entity\Entity;
use Micro\Plugin\Eav\Doctrine\Entity\Value\Type\BooleanType;
use Micro\Plugin\Eav\Doctrine\Entity\Value\Type\DateTimeType;
use Micro\Plugin\Eav\Doctrine\Entity\Value\Type\DateType;
use Micro\Plugin\Eav\Doctrine\Entity\Value\Type\FloatType;
use Micro\Plugin\Eav\Doctrine\Entity\Value\Type\IntegerType;
use Micro\Plugin\Eav\Doctrine\Entity\Value\Type\StringType;
use Micro\Plugin\Eav\Doctrine\Entity\Value\Type\TextType;
use Micro\Plugin\Eav\Entity\Value\ValueInterface;

/**
 * Class AbstractValue
 *
 *
 * @ORM\Entity()
 * @ORM\Table(name="micro_eav_abstract_value", indexes={
 *   @ORM\Index(name="rel_idx", columns={"attribute_id", "entity_id"})
 *     })
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="value_type", type="integer")
 * @ORM\DiscriminatorMap({
 *     1 => BooleanType::class,
 *     2 => IntegerType::class,
 *     3 => FloatType::class,
 *     4 => StringType::class,
 *     5 => TextType::class,
 *     9 => DateType::class,
 *     10 => DateTimeType::class
 * })
 */
#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_abstract')]
#[ORM\Index(columns: ['attribute_id', 'entity_id'], name: 'rel_idx')]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn('value_type', type: 'integer')]
#[ORM\DiscriminatorMap([
    1 => BooleanType::class,
    2 => IntegerType::class,
    3 => FloatType::class,
    4 => StringType::class,
    5 => TextType::class,
    9 => DateType::class,
    10 => DateTimeType::class
])]
abstract class AbstractValue implements ValueInterface
{
    use EavCoreModelTrait;

    /**
     * @var mixed
     */
    protected mixed $value;

    /**
     * @var Entity
     * @ORM\ManyToOne(
     *     targetEntity="Entity",
     *     inversedBy="values",
     *     fetch="EXTRA_LAZY",
     *     cascade={"persist"}
     *     )
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * @ORM\Cache("NONSTRICT_READ_WRITE", region="eav")
     */
    #[ORM\ManyToOne(targetEntity: Entity::class, cascade: ['persist'], fetch: 'EXTRA_LAZY', inversedBy: 'values')]
    protected $entity;

    /**
     * @var Attribute
     * @ORM\ManyToOne(
     *     targetEntity="Attribute",
     *     fetch="LAZY",
     *     cascade={"persist"}
     *     )
     * @ORM\JoinColumn(name="attribute_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    #[ORM\ManyToOne(targetEntity: Attribute::class, cascade: ['persist'], fetch: 'LAZY')]
    protected Attribute $attribute;

    /**
     * {@inheritDoc}
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function setValue(mixed $value): self
    {
        $this->value = $value;

        return $this;
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
     * @return self
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
     * @return self
     */
    public function setAttribute(Attribute $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->value;
    }
}
