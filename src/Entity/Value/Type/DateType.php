<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Entity\Value\ValueHasDefaultInterface;
use Micro\Plugin\Eav\Exception\InvalidArgumentException;

// phpcs:ignoreFile

/**
 * Class DateType
 *
 * @ORM\Table(name="micro_eav_value_date",indexes={
 *   @ORM\Index(name="rel_idx", columns={"attribute_id", "entity_id"})
 * })
 * @ORM\Entity()
 */

#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_date')]
#[ORM\Index(columns: ['attribute_id', 'entity_id'], name: 'rel_idx')]
class DateType extends AbstractValue implements ValueHasDefaultInterface
{
    /**
     * @var \DateTime
     * @ORM\Column( name="val", type="DateTime", nullable=false )
     */
    #[ORM\Column(name: 'val', type: 'datetime', nullable: false)]
    protected mixed $value = null;

    /**
     * @return \DateTime|null
     */
    public function getValue(): ?\DateTime
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

        return $v->format('Y-m-d');
    }
}
