<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Entity\Value\ValueHasDefaultInterface;

/**
 * Class DateTimeType
 *
 * @ORM\Table(name="micro_eav_value_datetime")
 * @ORM\Entity()
 */
#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_datetime')]
class DateTimeType extends AbstractValue implements ValueHasDefaultInterface
{
    /**
     * @var \DateTime
     * @ORM\Column( name="val", type="date", nullable=false )
     */
    #[ORM\Column(name: 'val', type: 'date', nullable: false)]
    protected mixed $value = null;

    /**
     * {@inheritDoc}
     */
    public function getCastType(): string
    {
        return \DateTime::class;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        $v = $this->value;
        if(!$v) {
            return '';
        }

        return $v->format(DATE_ATOM);
    }
}
