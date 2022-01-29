<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Attribute\Attribute;
use Micro\Plugin\Eav\Doctrine\Entity\Entity\Entity;
use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Entity\Value\ValueHasDefaultInterface;
use Micro\Plugin\Eav\Exception\InvalidArgumentException;

/**
 * Class DateTimeType
 *
 * @ORM\Table(name="micro_eav_value_datetime",indexes={
 *   @ORM\Index(name="rel_idx", columns={"attribute_id", "entity_id"})
 * })
 * @ORM\Entity()
 */

#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_datetime')]
#[ORM\Index(columns: ['attribute_id', 'entity_id'], name: 'rel_idx')]
class DateTimeType extends AbstractValue implements ValueHasDefaultInterface
{
    /**
     * @var \DateTime
     * @ORM\Column( name="val", type="date", nullable=false )
     */
    #[ORM\Column(name: 'val', type: 'date', nullable: false)]
    protected mixed $value = null;

    /**
     * @return \DateTimeInterface|null
     */
    public function getValue(): ?\DateTimeInterface
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        $v = $this->value;
        if (!$v) {
            return '';
        }

        return $v->format(DATE_ATOM);
    }
}
