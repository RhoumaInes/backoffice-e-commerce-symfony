<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\CarrierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarrierRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Carrier
{
    use Timestampable;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $state = null;

    #[ORM\OneToMany(mappedBy: 'carrier', targetEntity: CarrierPrice::class, orphanRemoval: true)]
    private Collection $carrierPrices;

    public function __construct()
    {
        $this->carrierPrices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function isState(): ?bool
    {
        return $this->state;
    }

    public function setState(bool $state): static
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection<int, CarrierPrice>
     */
    public function getCarrierPrices(): Collection
    {
        return $this->carrierPrices;
    }

    public function addCarrierPrice(CarrierPrice $carrierPrice): static
    {
        if (!$this->carrierPrices->contains($carrierPrice)) {
            $this->carrierPrices->add($carrierPrice);
            $carrierPrice->setCarrier($this);
        }

        return $this;
    }

    public function removeCarrierPrice(CarrierPrice $carrierPrice): static
    {
        if ($this->carrierPrices->removeElement($carrierPrice)) {
            // set the owning side to null (unless already changed)
            if ($carrierPrice->getCarrier() === $this) {
                $carrierPrice->setCarrier(null);
            }
        }

        return $this;
    }
}
