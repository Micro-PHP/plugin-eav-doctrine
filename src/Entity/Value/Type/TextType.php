<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Entity\Value\ValueHasDefaultInterface;

/**
 * Class TextType
 *
 * @ORM\Table(name="micro_eav_value_text",indexes={
 *   @ORM\Index(name="rel_idx", columns={"attribute_id", "entity_id"})
 * })
 * @ORM\Entity()
 */

#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_text')]
#[ORM\Index(columns: ['attribute_id', 'entity_id'], name: 'rel_idx')]
class TextType extends AbstractValue implements ValueHasDefaultInterface
{
    /**
     * @var string
     * @ORM\Column( name="val", type="text", nullable=false)
     */
    #[ORM\Column(name: 'val', type: 'text', nullable: false)]
    protected mixed $value = null;

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }
}
