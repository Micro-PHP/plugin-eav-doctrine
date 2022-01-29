<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Value\Type;

use Micro\Plugin\Eav\Doctrine\Entity\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Entity\Value\ValueHasDefaultInterface;

/**
 * Class StringType
 *
 * @ORM\Table(name="micro_eav_value_string",indexes={
 *   @ORM\Index(name="rel_idx", columns={"attribute_id", "entity_id"})
 * })
 * @ORM\Entity()
 */
#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_value_string')]
#[ORM\Index(columns: ['attribute_id', 'entity_id'], name: 'rel_idx')]
class StringType extends AbstractValue implements ValueHasDefaultInterface
{
    /**
     * @var string
     * @ORM\Column( name="val", type="string", nullable=true , length=2048)
     */
    #[ORM\Column(name: 'val', type: 'string', length: 2048, nullable: false)]
    protected mixed $value = null;

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }
}
