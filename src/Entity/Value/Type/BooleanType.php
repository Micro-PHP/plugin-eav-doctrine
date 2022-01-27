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

    public const TYPE = 'bool';

    /**
     * @var boolean
     * @ORM\Column( name="val", type="boolean", nullable=false )
     */
    #[ORM\Column(name: 'val', type: 'boolean', nullable: false)]
    protected bool $value = false;

    /**
     * {@inheritDoc}
     */
    public function getCastType(): string
    {
        return self::getType();
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return $this->value ? 'true': 'false';
    }

    /**
     * @param bool $value
     * @return AbstractValue
     */
    public function setValue(bool $value): AbstractValue
    {
        $this->value = $value;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public static function getType(): string
    {
        return 'bool';
    }

    /**
     * @return bool
     */
    public function getValue(): bool
    {
        return $this->value;
    }
}
