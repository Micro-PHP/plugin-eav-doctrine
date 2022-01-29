<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Entity\Value\ValueHasDefaultInterface;
use Micro\Plugin\Eav\Exception\InvalidArgumentException;

/**
 * Class BooleanType
 *
 * @ORM\Table(name="micro_eav_value_boolean",indexes={
 *   @ORM\Index(name="rel_idx", columns={"attribute_id", "entity_id"})
 * })
 * @ORM\Entity()
 *
 */
#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_boolean')]
#[ORM\Index(columns: ['attribute_id', 'entity_id'], name: 'rel_idx')]
class BooleanType extends AbstractValue implements ValueHasDefaultInterface
{
    /**
     * @var boolean
     *
     * @ORM\Column( name="val", type="boolean", nullable=false )
     */
    #[ORM\Column(name: 'val', type: 'boolean', nullable: false)]
    protected mixed $value = null;

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return $this->value ? 'true': 'false';
    }

    /**
     * @return bool|null
     */
    public function getValue(): ?bool
    {
        return $this->value;
    }
}
