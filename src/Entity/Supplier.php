<?php

namespace App\Entity;

use App\Repository\SupplierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SupplierRepository::class)]
class Supplier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $address = null;

    #[ORM\OneToMany(targetEntity: Item::class, mappedBy: 'supplier')]
    private Collection $items;

    #[ORM\Column(type: 'string', length: 8)]
    #[Assert\Regex(
        pattern: '/^\d{3}-\d{4}$/',
        message: 'The phone number must be in the format xxx-xxxx.'
    )]
    private ?string $phone = null;

    #[ORM\Column(type: 'string', length: 255, unique: true)] 
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private ?string $website = null;

     #[ORM\Column(type: 'string', length: 255, unique: true)] 
    private ?string $country = null;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setWebsite(string $website): static
    {
        $this->website = $website;
        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;
        return $this;
    }

    public function addItem(Item $item): static 
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setSupplier($this); 
        }
        return $this;
    }

    public function removeItem(Item $item): static 
    {
        if ($this->items->removeElement($item)) {
            if ($item->getSupplier() === $this) {
                $item->setSupplier(null);
            }
        }
        return $this;
    }
}
