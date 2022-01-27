<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Attribute\Attribute;
use Micro\Plugin\Eav\Doctrine\Entity\Entity\Entity;
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
    public const TYPE = 'datetime';

    /**
     * @var \DateTime
     * @ORM\Column( name="val", type="date", nullable=false )
     */
    #[ORM\Column(name: 'val', type: 'date', nullable: false)]
    protected \DateTime $value;

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

    /**
     * @param \DateTime $value
     * @return $this
     */
    public function setValue(\DateTime $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValue(): DateTime
    {
        return $this->value;
    }
}
