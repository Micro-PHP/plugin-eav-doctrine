<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Entity\Value\ValueHasDefaultInterface;

/**
 * Class IntegerType
 *
 * @ORM\Table(name="micro_eav_value_integer")
 * @ORM\Entity()
 */
#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_integer')]
class IntegerType extends AbstractValue implements ValueHasDefaultInterface
{
    /**
     * @var float
     * @ORM\Column( name="val", type="integer", nullable=true )
     */
    #[ORM\Column(name: 'val', type: 'integer', nullable: true)]
    protected mixed $value = null;

    /**
     * {@inheritDoc}
     */
    public function getCastType(): string
    {
        return 'int';
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return sprintf('%d', $this->value );
    }
}
