<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Entity\Value\ValueHasDefaultInterface;

/**
 * Class TextType
 *
 * @ORM\Table(name="micro_eav_value_text")
 * @ORM\Entity()
 */
#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_text')]
class TextType extends AbstractValue implements ValueHasDefaultInterface
{
    public const TYPE = 'text';

    /**
     * @var string
     * @ORM\Column( name="val", type="text", nullable=false)
     */
    #[ORM\Column(name: 'val', type: 'text', nullable: false)]
    protected string $value;

    /**
     * {@inheritDoc}
     */
    public function getCastType(): string
    {
        return 'string';
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
