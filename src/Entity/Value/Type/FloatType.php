<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Entity\Value\ValueHasDefaultInterface;

/**
 * Class FloatType
 *
 * @ORM\Table(name="micro_eav_value_float")
 * @ORM\Entity()
 */
#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_float')]
class FloatType extends AbstractValue implements ValueHasDefaultInterface
{
    public const TYPE = 'float';

    /**
     * @var float
     * @ORM\Column( name="val", type="float", nullable=false )
     */
    #[ORM\Column(name: 'val', type: 'float', nullable: false)]
    protected float $value;

    /**
     * {@inheritDoc}
     */
    public function getCastType(): string
    {
        return self::TYPE;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return sprintf('%f', $this->value );
    }

    /**
     * @param float $value
     *
     * @return $this
     */
    public function setValue(float $value): self
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }
}
