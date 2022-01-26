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
    /**
     * @var string
     * @ORM\Column( name="val", type="text", nullable=true)
     */
    #[ORM\Column(name: 'val', type: 'text', nullable: true)]
    protected mixed $value = null;

    /**
     * {@inheritDoc}
     */
    public function getCastType(): string
    {
        return 'string';
    }
}
