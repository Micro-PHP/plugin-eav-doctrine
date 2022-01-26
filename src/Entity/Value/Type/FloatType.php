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
    /**
     * @var float
     * @ORM\Column( name="val", type="float", nullable=true )
     */
    #[ORM\Column(name: 'val', type: 'float', nullable: true)]
    protected mixed $value = null;

    /**
     * {@inheritDoc}
     */
    public function getCastType(): string
    {
        return 'float';
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return sprintf('%f', $this->value );
    }
}
