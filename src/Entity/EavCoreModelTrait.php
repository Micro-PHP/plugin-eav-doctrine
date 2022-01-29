<?php

namespace Micro\Plugin\Eav\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

trait EavCoreModelTrait
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected int $id;

    /**
     * @return int
     */
    public function getId(): string
    {
        return (string)$this->id;
    }
}
