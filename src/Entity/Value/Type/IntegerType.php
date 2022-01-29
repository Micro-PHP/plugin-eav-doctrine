<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Entity\Value\ValueHasDefaultInterface;
use Micro\Plugin\Eav\Exception\InvalidArgumentException;

/**
 * Class IntegerType
 *
 * @ORM\Table(name="micro_eav_value_integer",indexes={
 *   @ORM\Index(name="rel_idx", columns={"attribute_id", "entity_id"})
 * })
 * @ORM\Entity()
 */
#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_integer')]
#[ORM\Index(columns: ['attribute_id', 'entity_id'], name: 'rel_idx')]
class IntegerType extends AbstractValue implements ValueHasDefaultInterface
{
    /**
     * @var int
     * @ORM\Column( name="val", type="integer", nullable=false )
     */
    #[ORM\Column(name: 'val', type: 'integer', nullable: false)]
    protected mixed $value = null;

    /**
     * @return int|null
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return sprintf('%d', $this->value );
    }

}
