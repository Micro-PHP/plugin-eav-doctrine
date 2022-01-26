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
    /**
     * @var string
     * @ORM\Column( name="val", type="string", nullable=true , length=2048)
     */
    #[ORM\Column(name: 'val', type: 'string', length: 2048, nullable: true)]
    protected mixed $value = null;

    /**
     * {@inheritDoc}
     */
    public function getCastType(): string
    {
        return 'string';
    }
}
