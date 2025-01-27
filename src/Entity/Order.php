<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billreference = null;

    #[ORM\Column]
    private ?int $ordernumber = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Client $client = null;

    #[ORM\Column(nullable: true)]
    private ?float $total = null;

    #[ORM\Column(nullable: true)]
    private ?bool $state = null;

    #[ORM\OneToMany(mappedBy: 'orderid', targetEntity: OrderProduct::class, cascade: ['persist', 'remove'])]
    private Collection $orderProduct;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Carrier $carrier = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?CarrierPrice $carrierPrice = null;

    public function __construct()
    {
        $this->orderProduct = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getBillreference(): ?string
    {
        return $this->billreference;
    }

    public function setBillreference(?string $billreference): static
    {
        $this->billreference = $billreference;

        return $this;
    }

    public function getOrdernumber(): ?int
    {
        return $this->ordernumber;
    }

    public function setOrdernumber(int $ordernumber): static
    {
        $this->ordernumber = $ordernumber;

        return $this;
    }


    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function isState(): ?bool
    {
        return $this->state;
    }

    public function setState(?bool $state): static
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection<int, OrderProduct>
     */
    public function getOrderProduct(): Collection
    {
        return $this->orderProduct;
    }

    public function addOrderProduct(OrderProduct $orderProduct): self
    {
        $this->orderProduct[] = $orderProduct;
        $orderProduct->setOrderid($this); // Assurez-vous que la relation inverse est correctement définie.

        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct): self
    {
        if ($this->orderProduct->contains($orderProduct)) {
            $this->orderProduct->removeElement($orderProduct);
            // Supprime la relation côté inverse si nécessaire
            if ($orderProduct->getOrderid() === $this) {
                $orderProduct->setOrderid(null);
            }
        }

        return $this;
    }

    /**
     * Définit les produits de la commande.
     *
     * @param array|Collection $orderProducts
     * @return static
     */
    public function setOrderProducts($orderProducts): static
    {
        // Supprime tous les produits existants
        foreach ($this->orderProduct as $existingOrderProduct) {
            $this->removeOrderProduct($existingOrderProduct);
        }

        // Ajoute les nouveaux produits
        foreach ($orderProducts as $orderProduct) {
            $this->addOrderProduct($orderProduct);
        }

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCarrierPrice(): ?CarrierPrice
    {
        return $this->carrierPrice;
    }

    public function setCarrierPrice(?CarrierPrice $carrierPrice): static
    {
        $this->carrierPrice = $carrierPrice;

        return $this;
    }
}
