<?php

namespace Micro\Plugin\Eav\Doctrine\Entity\Attribute;


use Micro\Plugin\Eav\Doctrine\Entity\EavCoreModelTrait;
use Micro\Plugin\Eav\Doctrine\Entity\Schema\Schema;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Micro\Plugin\Eav\Doctrine\Entity\Unique\UniqueIndex;
use Micro\Plugin\Eav\Entity\Attribute\AttributeInterface;
use Micro\Plugin\Eav\Entity\Schema\SchemaInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="micro_eav_attribute")
 */
#[ORM\Entity]
#[ORM\Table(name: 'micro_eav_attribute')]
class Attribute implements AttributeInterface
{
    use EavCoreModelTrait;

    /**
     * @var string
     *
     * @ORM\Column(
     *     name="name",
     *     type="string",
     *     length=50,
     *     nullable=false
     *     )
     *  @Assert\Regex(
     *     match=true,
     *     pattern="/^[a-z0-9\-\_]+$/i",
     *     message="Attribute name is not valid."
     * )
     */
    #[ORM\Column(name: 'name', type: 'string', length: 50, nullable: false)]
    private string $name;

    /**
     * @var string
     * @ORM\Column(
     *     name="type",
     *     type="string",
     *     length=50,
     *     nullable=false
     *     )
     */
    #[ORM\Column(name: 'type', type: 'string', length: 50, nullable: false)]
    private string $type;

    /**
     * @var boolean
     * @ORM\Column(
     *     name="nullable",
     *     type="boolean",
     *     nullable=false
     *     )
     */
    #[ORM\Column(name: 'nullable', type: 'boolean', nullable: false)]
    private bool $nullable = true;

    /**
     * @var boolean
     * @ORM\Column(
     *     name="is_unique",
     *     type="boolean",
     *     nullable=false
     *     )
     */
    #[ORM\Column(name: 'is_unique', type: 'boolean', nullable: false)]
    private bool $isUnique = false;

    /**
     * @var integer|null
     * @ORM\Column(
     *     name="length",
     *     type="integer",
     *     nullable=true
     *     )
     */
    #[ORM\Column(name: 'length', type: 'integer', nullable: true)]
    private ?int $length;

    /**
     * @var string|null
     * @ORM\Column( name="description", type="text", nullable=true )
     */
    #[ORM\Column(name: 'description', type: 'text', nullable: true)]
    private ?string $description;

    /**
     * @var String
     * @ORM\Column( name="default_value", type="string", length=256, nullable=true)
     */
    #[ORM\Column(name: 'default_value', type: 'string', length: 256, nullable: true)]
    private ?string $defaultValue;

    /**
     * @var SchemaInterface
     * @ORM\ManyToOne(
     *     targetEntity="Schema",
     *     fetch="EXTRA_LAZY",
     *     inversedBy="attributes"
     * )
     * @ORM\JoinColumn(name="schema_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    #[ORM\ManyToOne(targetEntity: Schema::class, fetch: 'EXTRA_LAZY', inversedBy: 'attributes')]
    #[ORM\JoinColumn(name: 'schema_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private SchemaInterface $schema;

    /**
     * @var ArrayCollection<UniqueIndex>
     * @ORM\OneToMany(
     *     targetEntity="UniqueIndex",
     *     mappedBy="attribute",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=false
     * )
     */
    #[ORM\OneToMany(mappedBy: 'attribute', targetEntity: UniqueIndex::class, fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    private $uniqueIndexes;

    /**
     * @param Schema $schema
     * @param string $name
     * @param string $type
     */
    public function __construct(Schema $schema, string $name, string $type)
    {
        $this->uniqueIndexes = new ArrayCollection();

        $this->name = $name;
        $this->schema = $schema;
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }


    public function setName( string $name ): Attribute
    {

        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * {@inheritDoc}
     */
    public function getSchema(): ?SchemaInterface
    {
        return $this->schema;
    }

    /**
     * {@inheritDoc}
     */
    public function setSchema(SchemaInterface $Schema ): self
    {
        $this->schema = $Schema;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * {@inheritDoc}
     */
    public function setNullable(bool $nullable): Attribute
    {
        $this->nullable = $nullable;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * {@inheritDoc}
     */
    public function setLength(?int $length = null): Attribute
    {
        $this->length = $length;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription(?string $description = ''): Attribute
    {
        $this->description = $description;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setType(String $type): Attribute
    {
        $this->type = $type;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultValue(): ?String
    {
        return $this->defaultValue;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultValue(?string $defaultValue = ''): Attribute
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isUnique(): bool
    {
        return $this->isUnique;
    }

    /**
     * {@inheritDoc}
     */
    public function setIsUnique(bool $isUnique): Attribute
    {
        $this->isUnique = $isUnique;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        $message = sprintf('%s [%s]', $this->getName(), $this->getType());

        return $message . ($this->length ? sprintf(' (%d) ', $this->length) : '');
    }
}
