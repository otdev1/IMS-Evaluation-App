<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    /**
     * @var string|null Item SKU
     */
    #[ORM\Column(length: 255)]
    private ?string $sku = null;

    /**
     * @var string|null Item description
     */
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * @var int|null Height of item in centimeters
     */
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $heightInCm = null;

    /**
     * @var int|null Weight of item in kilograms
     */
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $weightInKg = null;

    /**
     * @var int|null Length of item in centimeters
     */
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $lengthInCm = null;

    /**
     * @var int|null Width of item in centimeters
     */
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $widthInCm = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2, nullable: true)]
    private ?string $cost = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    private ?Supplier $supplier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCost(): ?float
    {
        return (float) $this->cost;
    }

    public function setCost(?float $cost): static
    {
        $this->cost = (string) $cost;
        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): static
    {
        $this->sku = $sku;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getHeightInCm(): ?int
    {
        return $this->heightInCm;
    }

    public function setHeightInCm(?int $height): static
    {
        $this->heightInCm = $height;
        return $this;
    }

    public function getWeightInKg(): ?int
    {
        return $this->weightInKg;
    }

    public function setWeightInKg(?int $weight): static
    {
        $this->weightInKg = $weight;
        return $this;
    }

    public function getLengthInCm(): ?int
    {
        return $this->lengthInCm;
    }

    public function setLengthInCm(?int $lengthInCm): static
    {
        $this->lengthInCm = $lengthInCm;
        return $this;
    }

    public function getWidthInCm(): ?int
    {
        return $this->widthInCm;
    }

    public function setWidthInCm(?int $widthInCm): static
    {
        $this->widthInCm = $widthInCm;
        return $this;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): static
    {
        $this->supplier = $supplier;
        return $this;
    }
}
