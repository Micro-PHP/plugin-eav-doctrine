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
 * @ORM\DiscriminatorColumn(name="value_type", type="string")
 * @ORM\DiscriminatorMap({
 *     BooleanType::TYPE => BooleanType::class,
 *     IntegerType::TYPE => IntegerType::class,
 *     FloatType::TYPE => FloatType::class,
 *     StringType::TYPE => StringType::class,
 *     TextType::TYPE => TextType::class,
 *     DateType::TYPE => DateType::class,
 *     DateTimeType::TYPE => DateTimeType::class
 * })
 */
#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_abstract')]
#[ORM\Index(columns: ['attribute_id', 'entity_id'], name: 'rel_idx')]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn('value_type', type: 'string')]
#[ORM\DiscriminatorMap([
    BooleanType::TYPE => BooleanType::class,
    IntegerType::TYPE => IntegerType::class,
    FloatType::TYPE => FloatType::class,
    StringType::TYPE => StringType::class,
    TextType::TYPE => TextType::class,
    DateType::TYPE => DateType::class,
    DateTimeType::TYPE => DateTimeType::class
])]
abstract class AbstractValue implements ValueInterface
{
    use EavCoreModelTrait;

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
     * @param Entity $entity
     * @param Attribute $attribute
     */
    public function __construct(Entity $entity, Attribute $attribute)
    {
        $this->entity = $entity;
        $this->attribute = $attribute;
    }

    /**
     * @return Entity
     */
    public function getEntity(): Entity
    {
        return $this->entity;
    }

    /**
     * @return Attribute
     */
    public function getAttribute(): Attribute
    {
        return $this->attribute;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->value;
    }
}
