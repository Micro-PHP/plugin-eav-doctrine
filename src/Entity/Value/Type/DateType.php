<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Entity\Value\ValueHasDefaultInterface;

/**
 * Class DateType
 *
 * @ORM\Table(name="micro_eav_value_date")
 * @ORM\Entity()
 */
#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_date')]
class DateType extends AbstractValue implements ValueHasDefaultInterface
{
    public const TYPE = 'date';

    /**
     * @var \DateTime
     * @ORM\Column( name="val", type="DateTime", nullable=false )
     */
    #[ORM\Column(name: 'val', type: 'datetime', nullable: false)]
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

        return $v->format('Y-m-d');
    }

    /**
     * @return \DateTime
     */
    public function getValue(): \DateTime
    {
        return $this->value;
    }
}
