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
    public const TYPE = 'int';

    /**
     * @var int
     * @ORM\Column( name="val", type="integer", nullable=false )
     */
    #[ORM\Column(name: 'val', type: 'integer', nullable: false)]
    protected int $value;

    /**
     * {@inheritDoc}
     */
    public function getCastType(): string
    {
        return self::TYPE;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return sprintf('%d', $this->value );
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setValue(int $value): self
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
