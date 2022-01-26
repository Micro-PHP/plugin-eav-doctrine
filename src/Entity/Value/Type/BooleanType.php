<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Entity\Value\ValueHasDefaultInterface;

/**
 * Class BooleanType
 *
 * @ORM\Table(name="micro_eav_value_boolean")
 * @ORM\Entity()
 */
#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_boolean')]
class BooleanType extends AbstractValue implements ValueHasDefaultInterface
{
    /**
     * @var boolean
     * @ORM\Column( name="val", type="boolean", nullable=false )
     */
    #[ORM\Column(name: 'val', type: 'boolean', nullable: false)]
    protected mixed $value = false;

    /**
     * {@inheritDoc}
     */
    public function getCastType(): string
    {
        return 'boolean';
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return $this->value ? 'true': 'false';
    }
}
