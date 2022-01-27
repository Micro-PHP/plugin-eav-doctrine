<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Entity\Value\ValueHasDefaultInterface;

/**
 * Class StringType
 *
 * @ORM\Table(name="micro_eav_value_string")
 * @ORM\Entity()
 */
#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_string')]
class StringType extends AbstractValue implements ValueHasDefaultInterface
{
    public const TYPE = 'string';

    /**
     * @var string
     * @ORM\Column( name="val", type="string", nullable=true , length=2048)
     */
    #[ORM\Column(name: 'val', type: 'string', length: 2048, nullable: false)]
    protected string $value;

    /**
     * {@inheritDoc}
     */
    public function getCastType(): string
    {
        return self::TYPE;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
