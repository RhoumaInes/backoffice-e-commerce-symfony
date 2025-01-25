<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\CarrierPriceRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\CityEnum;

#[ORM\Entity(repositoryClass: CarrierPriceRepository::class)]
#[ORM\HasLifecycleCallbacks]
class CarrierPrice
{
    use Timestampable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, enumType: CityEnum::class)]
    private ?CityEnum $city = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'carrierPrices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Carrier $carrier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?CityEnum
    {
        return $this->city;
    }

    public function setCity(CityEnum $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCarrier(): ?Carrier
    {
        return $this->carrier;
    }

    public function setCarrier(?Carrier $carrier): static
    {
        $this->carrier = $carrier;

        return $this;
    }
}
