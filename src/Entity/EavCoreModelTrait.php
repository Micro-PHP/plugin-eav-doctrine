<?php

namespace Micro\Plugin\Eav\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

// phpcs:ignoreFile

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
    protected ?int $id = null;

    /**
     * @return int
     */
    public function getId(): ?string
    {
        return $this->id === null ? null : (string)$this->id;
    }
}
