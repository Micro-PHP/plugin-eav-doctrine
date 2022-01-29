<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Entity\Value\ValueHasDefaultInterface;
use Micro\Plugin\Eav\Exception\InvalidArgumentException;

/**
 * Class FloatType
 *
 * @ORM\Table(name="micro_eav_value_float",indexes={
 *   @ORM\Index(name="rel_idx", columns={"attribute_id", "entity_id"})
 * })
 * @ORM\Entity()
 */

#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_float')]
#[ORM\Index(columns: ['attribute_id', 'entity_id'], name: 'rel_idx')]
class FloatType extends AbstractValue implements ValueHasDefaultInterface
{
    /**
     * @var float
     * @ORM\Column( name="val", type="float", nullable=false )
     */
    #[ORM\Column(name: 'val', type: 'float', nullable: false)]
    protected mixed $valu = null;

    /**
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return sprintf('%f', $this->value);
    }
}
